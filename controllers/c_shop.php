<?php
require('src/connection.php');

if(!isset($_SESSION['connect'])){
  header('location: ../');
} elseif($_SESSION['admin'] == false) {
  require('admin/entities/Produit.php');
  if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET['id']);
    $prod = array();
    $re = $db->prepare('SELECT * FROM liste_prod JOIN produit ON liste_prod.id_prod = produit.id_prod WHERE id_menu = ?');
    $re->execute(array($id));
    if($re->rowCount() == 0){
      header('Location: shop.php?error=1');
    }
    $i = 0;
    while($produit = $re->fetch()){
      $prod[$i] = new Produit($produit['id_prod'], $produit['nom_prod'], $produit['type_prod']);
      $i++;
    }

    $re = $db->prepare('SELECT * FROM menu WHERE id_menu = ?');
    $re->execute(array($id));
    while($menu = $re->fetch()){
      $titre = $menu['nom_menu'];
      $prix = $menu['prix_menu'];
    }
  } elseif(!isset($_GET['error'])) {
    header('Location: shop.php?error=1');
  }
  if(isset($_GET['error'])){
    $error = htmlspecialchars($_GET['error']);
  }
} else {
  header('location: admin/');
}
require_once(PATH_VIEWS.$page.'.php');
?>
