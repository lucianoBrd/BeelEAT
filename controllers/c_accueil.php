<?php
require_once(PATH_MODELS.'UserDAO.php');
require_once(PATH_MODELS.'ProduitDAO.php');
require_once(PATH_MODELS.'MenuDAO.php');
require_once(PATH_ENTITY.'User.php');
$userDAO = new UserDAO();
$produitDAO = new ProduitDAO();
$menuDAO = new MenuDAO();

// Verifie si cookie existe
if(!empty($_COOKIE['log']) && !isset($_SESSION['connect'])){
  $log = htmlspecialchars($_COOKIE['log']);

  $user = $userDAO->getUserByKeySecret($log);
  if($user != null){
    $_SESSION['connect'] = 1;
    $_SESSION['pseudo'] = $user->getPseudo();
    $_SESSION['id'] = $user->getId();
    $_SESSION['admin'] = $user->getAdmin();
    header('location: ../');
  }
}

if(!empty($_POST['email']) && !empty($_POST['password'])){
  $email    = $_POST['email'];
  $password = $_POST['password'];
  $error    = 1;

  // Crypter
  $password = "aq1".sha1($password."1254")."25";

  $user = $userDAO->getUserByEmail($email);

  if($user != null && $password == $user->getPassword()){
    if($user->getActive()){
      $_SESSION['connect'] = 1;
      $_SESSION['pseudo'] = $user->getPseudo();
      $_SESSION['id'] = $user->getId();
      $_SESSION['admin'] = $user->getAdmin();
      $error = 0;
      // Creer cookie
      if(isset($_POST['check_connect'])){
        setcookie('log', $user->getKeySecret(), time() + 365*24*3600, null, null, false, true);
      }
      header('location: ../');
    }
  }
  if($error == 1){
    header('location: ../?error=INCONNUE&email='.$email.'');
  }
}

if(isset($_GET['error'])){
  $error = htmlspecialchars($_GET['error']);
  $alert = choixAlert($error);
}

if(!isset($_SESSION['connect'])){
  require_once(PATH_VIEWS.$page.'.php');
} elseif ($_SESSION['admin'] == false) {
  $produitImgListe = $produitDAO->getProduitJoinImage();
  $menuImgListe = $menuDAO->getMenuJoinImage();
  require_once(PATH_VIEWS.'accueilC.php');
}
