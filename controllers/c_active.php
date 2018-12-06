<?php
require_once(PATH_MODELS.'UserDAO.php');
require_once(PATH_ENTITY.'User.php');
$userDAO = new UserDAO();

if(isset($_GET['keygen']) && isset($_GET['keysecret'])){
  if(!empty($_GET['keygen']) && !empty($_GET['keysecret'])){
    $keygen = $_GET['keygen'];
    $keysecret = $_GET['keysecret'];

    $user = $userDAO->getUserByKeySecret($keysecret);
    if($user != null){
      if($user->getActive()){
        header('location: ../?page='.$page.'&error=ACTIVE');
        exit();
      } else {
        if($user->getKeygen() == $keygen){
          $userDAO->activeUser($user->getEmail());
          header('location: ../?page='.$page.'&error=ACTIVEOK');
          exit();
        } else {
          header('location: ../?page='.$page.'&error=ERREUR');
          exit();
        }
      }
    } else {
      header('location: ../?page='.$page.'&error=ERREUR');
      exit();
    }
  } else {
    header('location: ../?page='.$page.'&error=ERREUR');
  }
}
if(isset($_GET['error'])){
  $error = htmlspecialchars($_GET['error']);
  $alert = choixAlert($error);
}
require_once(PATH_VIEWS.$page.'.php');
