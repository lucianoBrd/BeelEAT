<?php
require_once(PATH_MODELS.'UserDAO.php');
require_once(PATH_ENTITY.'User.php');
$userDAO = new UserDAO();

if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_confirm'])){
  $pseudo           = $_POST['pseudo'];
  $email            = $_POST['email'];
  $password         = $_POST['password'];
  $password_confirm = $_POST['password_confirm'];
  $error = false;

  // Test mdp identiques
  if($password != $password_confirm){
    $error = 'PASS';
  }

  // Test mail existe
  $email_verification = $userDAO->getNbUserByEmail($email);

  if($email_verification['numberEmail'] != 0){
    $error = 'EMAIL';
  }

  if($error == false){
    // Hash
    $secret = sha1($email).time();
    $secret = sha1($secret).time().time();

    // Crypatge Mdp
    // Grain de sel : 1254
    $password = "aq1".sha1($password."1254")."25";

    // Creer keygen
    $keygen = sha1($pseudo).time().time();

    // Envoie de la requete
    $user = new User(null, null, $pseudo, $email, $password, null, $secret, $keygen, null);
    $insert = $userDAO->newUser($user);
    if($insert){
      header('location: ../?page=inscription&error=SUCCESS');
    } else {
      header('location: ../?page=inscription&error=ERREUR');
    }
  } else {
    header('location: ../?page=inscription&error='.$error);
  }

}
if(isset($_GET['error'])){
  $error = htmlspecialchars($_GET['error']);
  $alert = choixAlert($error);
}
require_once(PATH_VIEWS.$page.'.php');
?>
