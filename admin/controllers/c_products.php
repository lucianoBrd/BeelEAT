<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    $page = 'products';
    $req = $db->prepare('SELECT * FROM produit');
    $req->execute(array());
    require_once(PATH_VIEWS.'products.php');
  }
