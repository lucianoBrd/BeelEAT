<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    $page = 'menu';
    $req = $db->prepare('SELECT * FROM menu');
    $req->execute(array());
    require_once(PATH_VIEWS.'menuB.php');
  }
