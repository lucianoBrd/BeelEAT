<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    $page = 'accueil';
    require_once(PATH_VIEWS.'accueil.php');
  }
