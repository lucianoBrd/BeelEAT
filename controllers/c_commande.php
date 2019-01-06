<?php
require_once(PATH_MODELS.'CommandeDAO.php');
require_once(PATH_MODELS.'IngredientDAO.php');
require_once(PATH_MODELS.'ListeProdCommDAO.php');
require_once(PATH_MODELS.'ListeIngreCommDAO.php');
require_once(PATH_MODELS.'MenuDAO.php');
require_once(PATH_MODELS.'UserDAO.php');
require_once(PATH_MODELS.'ProduitDAO.php');
require_once(PATH_ENTITY.'ListeProdComm.php');
require_once(PATH_ENTITY.'Commande.php');
require_once(PATH_ENTITY.'ListeIngreComm.php');
require_once(PATH_MAIL);
$commandeDAO = new CommandeDAO();
$ingredientDAO = new IngredientDAO();
$listeProdCommDAO = new ListeProdCommDAO();
$listeIngreCommDAO = new ListeIngreCommDAO();
$menuDAO = new MenuDAO();
$userDAO = new UserDAO();
$produitDAO = new ProduitDAO();

if(!isset($_SESSION['connect'])){
  header('location: ../');
} elseif($_SESSION['admin'] == false) {
  if(isset($_SESSION['commande']) || isset($_GET['prod'])){
    if(isset($_SESSION['commande'])){
      $menu = $menuDAO->getMenuById($_SESSION['commande']);

      $commande = new Commande(null, null, $_SESSION['id'], $menu->getPrix(), 'preparation', $_SESSION['commande'], null);
    } else {
      $produit = $produitDAO->getProduitByIDJoinImage($_GET['prod']);

      $commande = new Commande(null, null, $_SESSION['id'], $produit[0]->getPrix(), 'preparation', null, $_GET['prod']);
    }

    $insert = $commandeDAO->newCommande($commande);

    if($insert == false){
      header('Location: ../?page=checkout&id='.$_SESSION['commande'].'error=COMMANDE_FALSE');
    } else {
      $idComm = $commandeDAO->getLastCommandeID();
      if(isset($_SESSION['prod'])){
        foreach ($_SESSION['prod'] as $prod) {
          if($prod != -1){
            $listeProdComm = new ListeProdComm(null, $prod, $idComm);
            $listeProdCommDAO->newListeProdComm($listeProdComm);
            $produitDAO->decrementProduit($prod);
          }
        }
      }
      if(isset($_SESSION['ingre'])){
        foreach ($_SESSION['ingre'] as $ingre) {
          if($ingre != -1){
            $listeIngreComm = new ListeIngreComm(null, $idComm, $ingre);
            $listeIngreCommDAO->newListeIngreComm($listeIngreComm);
            $ingredientDAO->decrementIngredient($ingre);
          }
        }
      }
      unset($_SESSION['prod']);
      unset($_SESSION['ingre']);
      unset($_SESSION['commande']);
      $user = $userDAO->getNbUserById($_SESSION['id']);
      email($user->getEmail(), 'BeelEAT | Confirmation de commande', 'Confirmation de commande', 'Bonjour '.$user->getPseudo().',', 'Votre commande numéro '.$idComm.' est en cours de préparation.');
      header('Location: ../?error=COMMANDE_TRUE#about');
    }
  }
}
