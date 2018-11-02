<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    require_once(PATH_MODELS.'MenuDAO.php');
    require_once(PATH_ENTITY.'Produit.php');
    $menuDAO = new MenuDAO();
    $menuListe = $menuDAO->getMenu();
    require_once(PATH_VIEWS_ADMIN.$page.'.php');
  }
