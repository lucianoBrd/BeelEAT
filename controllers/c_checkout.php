<?php
require('src/connection.php');

if(!isset($_SESSION['connect'])){
  header('location: ../');
} elseif($_SESSION['admin'] == false) {
  if(isset($_GET['1'])){

    $req = $db->prepare('INSERT INTO commande(user_comm, prix_comm, statut_comm, menu_comm)
                         VALUES (?, ?, ?, ?)');
    $req->execute(array($_SESSION['id'], $_GET['prix'], 'preparation', $_GET['id']));

    $req = $db->query('SELECT * FROM commande WHERE id_comm=(SELECT MAX(id_comm) FROM commande)');
    while($produit = $req->fetch()){
      $idComm = $produit['id_comm'];
    }
    $req->closeCursor();

    $req = $db->prepare('INSERT INTO liste_prod_comm(id_prod, id_comm)
                         VALUES (?, ?)');
    $req->execute(array($_GET['1'], $idComm));
    if(isset($_GET['2'])){
      $req = $db->prepare('INSERT INTO liste_prod_comm(id_prod, id_comm)
                           VALUES (?, ?)');
      $req->execute(array($_GET['2'], $idComm));
    }
    if(isset($_GET['3'])){
      $req = $db->prepare('INSERT INTO liste_prod_comm(id_prod, id_comm)
                           VALUES (?, ?)');
      $req->execute(array($_GET['3'], $idComm));
    }
    header('Location: ../?commande=true#about');
  }
  if(isset($_GET['id']) && !isset($_GET['1'])){
    $id = htmlspecialchars($_GET['id']);
    $menu = array();
    $i = 0;
    foreach ( $_POST as $post => $val )  {
      $menu[$i] = $val;
      $i++;
    }
    $re = $db->prepare('SELECT * FROM menu WHERE id_menu = ?');
    $re->execute(array($id));
    if($re->rowCount() == 0){
      header('Location: shop_checkout.php?error=1');
    }
    while($prod = $re->fetch()){
      $nom = $prod['nom_menu'];
      $prix = $prod['prix_menu'];
    }
  }

  if(isset($_GET['error'])){
    $error = htmlspecialchars($_GET['error']);
  }
} else {
  header('location: admin/');
}
require_once(PATH_VIEWS.$page.'.php');
?>
