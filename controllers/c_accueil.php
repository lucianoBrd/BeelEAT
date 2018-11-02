<?php
require(link.'src/connection.php');
// Verifie si cookie existe
if(!empty($_COOKIE['log']) && !isset($_SESSION['connect'])){
  $log = htmlspecialchars($_COOKIE['log']);

  $req = $db->prepare('SELECT * FROM users WHERE key_secret = ?');
  $req->execute(array($log));
  while($user = $req->fetch()){
    if($user['pseudo'] != null){
      $_SESSION['connect'] = 1;
      $_SESSION['pseudo'] = $user['pseudo'];
      $_SESSION['id'] = $user['id'];
      $_SESSION['admin'] = $user['admin'];
      header('location: ../?success=1');
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
      $_SESSION['id'] = $user['id'];
      $_SESSION['admin'] = $user['admin'];
      $error = 0;
      // Creer cookie
      if(isset($_POST['check_connect'])){
        setcookie('log', $user['key_secret'], time() + 365*24*3600, null, null, false, true);
      }
      header('location: ../?success=1');
    }
  }
  if($error == 1){
    header('location: ../?error=1&email='.$email.'');
  }
  $req->closeCursor();

}
if(!isset($_SESSION['connect'])){
  require_once(PATH_VIEWS.$page.'.php');
} elseif ($_SESSION['admin'] == false) {
  if(isset($_GET['commande'])){
    $commande = htmlspecialchars($_GET['commande']);
  }
  $req = $db->prepare('SELECT * FROM produit JOIN image ON image.produit_id = produit.id_prod WHERE statut_prod = "publie"');
  $req->execute(array());
  require_once(PATH_VIEWS.'accueilC.php');
}
