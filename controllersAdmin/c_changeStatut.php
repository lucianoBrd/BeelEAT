<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    require_once(PATH_MODELS.'CommandeDAO.php');
    $commandeDAO = new CommandeDAO();
    if(isset($_GET['id'])){
      $id = htmlspecialchars($_GET['id']);
      $commande = $commandeDAO->getCommandeById($id);
      if(isset($_GET['before'])){
        $before = htmlspecialchars($_GET['before']);
      } else {
        $before = 'accueil';
      }
      if($commande == null){
        header('Location: ../?error=ERREUR&page='.$before);
      } else {
        $update = $commandeDAO->updateStatutCommande($commande);
        if($update){
          header('Location: ../?page='.$before);
        } else {
          header('Location: ../?error=ERREUR$page='.$before);
        }
      }
    }
  }
