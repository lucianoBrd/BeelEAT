<?php
require_once(PATH_MODELS.'ListeProdDAO.php');
require_once(PATH_MODELS.'ListeIngreDAO.php');
require_once(PATH_MODELS.'MenuDAO.php');
require_once(PATH_MODELS.'ProduitDAO.php');
$listeProdDAO = new ListeProdDAO();
$listeIngreDAO = new ListeIngreDAO();
$menuDAO = new MenuDAO();
$produitDAO = new ProduitDAO();

if(!isset($_SESSION['connect'])){
  header('location: ../');
} elseif($_SESSION['admin'] == false) {
  if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET['id']);
    $prodListe = $listeProdDAO->getListeProduitById($id);

    if($prodListe == null){
      header('Location: ../?page=shop&error=ERREUR');
      exit();
    }

    $menu = $menuDAO->getMenuById($id);
    if($menu == null){
      header('Location: ../?page=shop&error=ERREUR');
      exit();
    }
  } elseif(isset($_GET['prod'])) {
    $prod = htmlspecialchars($_GET['prod']);
    $produit = $produitDAO->getProduitByIDJoinImage($prod);
    if($produit == null){
      header('Location: ../?page=shop&error=ERREUR');
      exit();
    }


  } elseif(!isset($_GET['error'])) {
    header('Location: ../?page=shop&error=ERREUR');
  }
  if(isset($_GET['error'])){
    $error = htmlspecialchars($_GET['error']);
    $alert = choixAlert($error);
  }
}
require_once(PATH_VIEWS.$page.'.php');
?>
