<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    require_once(PATH_MODELS.'ProduitDAO.php');
    $produitDAO = new ProduitDAO();
    $prodListe = $produitDAO->getProduit();
    require_once(PATH_VIEWS_ADMIN.$page.'.php');
  }
