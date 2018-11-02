<?php
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
require_once(PATH_VIEWS.$page.'.php');
?>
