<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    require_once(PATH_MODELS.'IngredientDAO.php');
    $ingredientDAO = new ingredientDAO();
    $ingreListe = $ingredientDAO->getIngredient();
    require_once(PATH_VIEWS_ADMIN.$page.'.php');
  }
