<?php
// Projet 3 : Connection
  session_start();
  if(isset($_SESSION['connect'])){
    header('location: ../');
  }
  require('src/connection.php');

  // Verifie si cookie existe
  if(!empty($_COOKIE['log']) && !isset($_SESSION['connect'])){
    $log = htmlspecialchars($_COOKIE['log']);

    $req = $db->prepare('SELECT * FROM users WHERE key_secret = ?');
    $req->execute(array($log));
    while($user = $req->fetch()){
      if($user['pseudo'] != null){
        $_SESSION['connect'] = 1;
        $_SESSION['pseudo'] = $user['pseudo'];
        header('location: ../connection.php?success=1');
      }
    }
    $req->closeCursor();
  }

  if(!empty($_POST['email']) && !empty($_POST['password'])){
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $error    = 1;

    // Crypter
    $password = "aq1".sha1($password."1254")."25";

    $req = $db->prepare('SELECT * FROM users WHERE email = ?');
    $req->execute(array($email));

    while($user = $req->fetch()){
      //print_r(users): print_r afficher tableau
      if($password == $user['password']){
        $_SESSION['connect'] = 1;
        $_SESSION['pseudo'] = $user['pseudo'];
        $error = 0;
        // Creer cookie
        if(isset($_POST['check_connect'])){
          setcookie('log', $user['key_secret'], time() + 365*24*3600, null, null, false, true);
        }
        header('location: ../connection.php?success=1');
      }
    }
    if($error == 1){
      header('location: ../connection.php?error=1');
    }
    $req->closeCursor();

  }

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">
    <title>PHP - Connexion</title>
    <meta name="author" content="Luciano">
    <link type="text/css" rel="stylesheet" href="design/default.css">
  </head>
  <body>
    <header>
      <h1>Connexion</h1>
    </header>

    <div class="container">
      <p>Bienvenue sur le site.</p>
      <p id="p_marge">Pas encore inscrit ? <a href="../">Inscrivez-vous</a></p>
      <?php
        if(isset($_GET['error'])){
          echo '<p id="error">Authentification impossible.</p>';
        } else if(isset($_GET['success'])){
          echo '<p id="success">Vous etes maintenant connecte.</p>';
        }
      ?>
      <form method="post" action="connection.php">
        <table>
          <tr>
            <td>Email</td>
            <td><input required class="form" placeholder="example@domaine.com" type="email" name="email"/></td>
          </tr>
          <tr>
            <td>Mot de passe</td>
            <td><input required class="form" placeholder="********" type="password" name="password"/></td>
          </tr>
        </table>
        <p><label><input checked type="checkbox" name="check_connect"/>Connexion automatique</label></p>
        <button class="form, centre" id="send" type="submit" name="connection">Connection</button>
      </form>
    </div>
  </body>
</html>
