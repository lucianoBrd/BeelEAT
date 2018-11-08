<?php

if(!isset($_SESSION['connect'])){
  header('location: ../');
} elseif($_SESSION['admin'] == false) {
    if(isset($_GET['id'])){
      $id = htmlspecialchars($_GET['id']);
      $_SESSION['commande'] = $id;
      $_SESSION['prod'] = array();
      foreach ( $_POST as $post => $val )  {
        $_SESSION['prod'][] = $val;
        $i++;
      }
      header('Location: ../?page=checkout');
    }
  }
?>
