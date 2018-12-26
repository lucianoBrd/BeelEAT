<?php

if(!isset($_SESSION['connect'])){
  header('location: ../');
} elseif($_SESSION['admin'] == false) {
    if(isset($_GET['id'])){
      $id = htmlspecialchars($_GET['id']);
      $_SESSION['commande'] = $id;
      $_SESSION['prod'] = array();
      $_SESSION['ingre'] = array();
      $_SESSION['prod'][] = $_POST[0];
      $_SESSION['prod'][] = $_POST[1];
      $_SESSION['prod'][] = $_POST[2];
      $_SESSION['ingre'][] = $_POST[3];
      $_SESSION['ingre'][] = $_POST[4];
      $i = 0;
      foreach ( $_POST as $post => $val )  {
        if($i>4){
          $_SESSION['ingre'][] = $_POST[$i];
        }
        $i++;
      }
      header('Location: ../?page=checkout');
    }
  }
?>
