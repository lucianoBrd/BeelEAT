<?php
require_once(PATH_MODELS.'CommandeDAO.php');
require_once(PATH_MODELS.'ListeProdCommDAO.php');
require_once(PATH_MODELS.'MenuDAO.php');
require_once(PATH_MODELS.'UserDAO.php');
require_once(PATH_ENTITY.'ListeProdComm.php');
require_once(PATH_ENTITY.'Commande.php');
require_once(PATH_MAIL);
$commandeDAO = new CommandeDAO();
$listeProdCommDAO = new ListeProdCommDAO();
$menuDAO = new MenuDAO();
$userDAO = new UserDAO();

if(!isset($_SESSION['connect'])){
  header('location: ../');
} elseif($_SESSION['admin'] == false) {
  if(isset($_SESSION['commande'])){
    $menu = $menuDAO->getMenuById($_SESSION['commande']);

    $commande = new Commande(null, null, $_SESSION['id'], $menu->getPrix(), 'preparation', $_SESSION['commande']);
    $insert = $commandeDAO->newCommande($commande);

    if($insert == false){
      header('Location: ../?page=checkout&id='.$_SESSION['commande'].'error=COMMANDE_FALSE');
    } else {
      $idComm = $commandeDAO->getLastCommandeID();
      foreach ($_SESSION['prod'] as $prod) {
        $listeProdComm = new ListeProdComm(null, $prod, $idComm);
        $listeProdCommDAO->newListeProdComm($listeProdComm);
      }
      unset($_SESSION['prod']);
      unset($_SESSION['commande']);
      $user = $userDAO->getNbUserById($_SESSION['id']);
      email($user->getEmail(), 'Confirmation de commande', 'Bonjour '.$user->getPseudo().',', 'Votre commande numéro '.$idComm.' est en cours de préparation!');
      header('Location: ../?error=COMMANDE_TRUE#about');
    }
  }
}
