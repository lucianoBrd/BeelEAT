<?php
// ctrl+n -> new fichier
// peut utiliser structure mvc pour php pour les fichiers
  session_start();
  // On a besoin de ce fichier : on l'implemente au debut de ce code
  require('src/connection.php');

  if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_confirm'])){
    $pseudo           = $_POST['pseudo'];
    $email            = $_POST['email'];
    $password         = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $error = 0;

    // Test mdp identiques
    if($password != $password_confirm){
      header('location: ../inscription.php?error=1&pass=1');
      $error = 1;
    }

    // Test mail existe
    $req = $db->prepare('SELECT count(*) as numberEmail FROM users WHERE email = ?');
    $req->execute(array($email));

    while($email_verification = $req->fetch()){
      if($email_verification['numberEmail'] != 0){
        header('location: ../inscription.php?error=1&email=1');
        $error = 1;
      }
    }
    $req->closeCursor();

    if($error == 0){
      // Hash
      $secret = sha1($email).time();
      $secret = sha1($secret).time().time();

      // Crypatge Mdp
      // Grain de sel : 1254
      $password = "aq1".sha1($password."1254")."25";

      // Envoie de la requete
      $req = $db->prepare('INSERT INTO users(pseudo, email, password, key_secret) VALUES (?, ?, ?, ?)');
      $req->execute(array($pseudo, $email, $password, $secret)) or die(print_r($req->errorInfo()));
      header('location: ../inscription.php?success=1');
    }

  }

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet">
    <title>PHP - Bienvenue</title>
    <meta name="author" content="Luciano">
    <link type="text/css" rel="stylesheet" href="design/default.css">
  </head>
  <body>

    <header>
      <h1>Inscription</h1>
    </header>

    <div class="container">
      <p>Bienvenue sur le site, inscrivez-vous pour plus d'information.</p>
      <p id="p_marge">Deja inscrit ? <a href="../">Connectez-vous</a></p>
      <?php
        if(isset($_GET['error'])){
          if(isset($_GET['pass'])){
            echo '<p id="error">Les mots de passe ne sont pas identiques.</p>';
          } else if(isset($_GET['email'])){
            echo '<p id="error">Adresse Email deja utilisée.</p>';
          }
        } else if(isset($_GET['success'])){
          echo '<p id="success">Inscription prise en compte.</p>';
        }
      ?>
      <form method="post" action="inscription.php">
        <table>
          <tr>
            <td>Pseudo</td>
            <td><input required class="form" placeholder="Name" type="text" name="pseudo"/></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><input required class="form" placeholder="example@domaine.com" type="email" name="email"/></td>
          </tr>
          <tr>
            <td>Mot de passe</td>
            <td><input required class="form" placeholder="********" type="password" name="password"/></td>
          </tr>
          <tr>
            <td>Confirmer mot de passe</td>
            <td><input required class="form" placeholder="********" type="password" name="password_confirm"/></td>
          </tr>
        </table>
        <button class="form, centre" id="send" type="submit" name="inscription">Inscription</button>
      </form>
    </div>
  </body>
</html>
