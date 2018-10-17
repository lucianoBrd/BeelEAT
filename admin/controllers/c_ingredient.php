<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    $page = 'ingredient';
    $req = $db->prepare('SELECT * FROM ingredient');
    $req->execute(array());
    require_once(PATH_VIEWS.'ingredient.php');
  }
