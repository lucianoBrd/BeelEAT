<?php
require_once(PATH_MODELS.'CommandeDAO.php');
require_once(PATH_MODELS.'MenuDAO.php');
require_once(PATH_MODELS.'ProduitDAO.php');
require_once(PATH_MODELS.'IngredientDAO.php');
require_once(PATH_ENTITY.'Commande.php');
require_once(PATH_ENTITY.'Produit.php');
$commandeDAO = new CommandeDAO();
$menuDAO = new MenuDAO();
$produitDAO = new ProduitDAO();
$ingredientDAO = new IngredientDAO();

if(!isset($_SESSION['connect'])){
  header('location: ../');
} elseif($_SESSION['admin'] == false) {
  if(isset($_SESSION['commande'])){
    $id = $_SESSION['commande'];
    $menu = $menuDAO->getMenuById($id);
    if($menu == null){
      header('Location: ../?page=checkout&error=COMMANDE_FALSE');
    } else {
      $listeProd = array();
      if(isset($_SESSION['prod'])){
        foreach ($_SESSION['prod'] as $prod)  {
          $listeProd[] = $produitDAO->getProduitByIDJoinImage($prod);
        }
      }
      $listeIngre = array();
      if(isset($_SESSION['ingre'])){
        foreach ($_SESSION['ingre'] as $ingre)  {
          $listeIngre[] = $ingredientDAO->getIngredientByID($ingre);
        }
      }
    }
  } else {
    header('Location: ../');
  }
}
if(isset($_GET['error'])){
  $error = htmlspecialchars($_GET['error']);
  $alert = choixAlert($error);
}
require_once(PATH_VIEWS.$page.'.php');
?>
