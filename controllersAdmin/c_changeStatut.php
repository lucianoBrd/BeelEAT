<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    require_once(PATH_MODELS.'CommandeDAO.php');
    $commandeDAO = new CommandeDAO();
    if(isset($_GET['id'])){
      $id = htmlspecialchars($_GET['id']);
      $commande = $commandeDAO->getCommandeById($id);
      if($commande == null){
        header('Location: ../?error=ERREUR');
      } else {
        $update = $commandeDAO->updateStatutCommande($commande);
        if($update){
          header('Location: ../');
        } else {
          header('Location: ../?error=ERREUR');
        }
      }
    }
  }
