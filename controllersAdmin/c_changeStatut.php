<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    require_once(PATH_MAIL);
    require_once(PATH_MODELS.'CommandeDAO.php');
    require_once(PATH_MODELS.'UserDAO.php');
    $commandeDAO = new CommandeDAO();
    $userDAO = new UserDAO();
    if(isset($_GET['id']) && isset($_GET['user'])){
      $id = htmlspecialchars($_GET['id']);
      $userId = htmlspecialchars($_GET['user']);
      $commande = $commandeDAO->getCommandeById($id);
      $user = $userDAO->getNbUserById($userId);
      if(isset($_GET['before'])){
        $before = htmlspecialchars($_GET['before']);
      } else {
        $before = 'accueil';
      }
      if($commande == null){
        header('Location: ../?error=ERREUR&page='.$before);
      } elseif($user == null) {
        header('Location: ../?error=ERREUR&page='.$before);
      } else {
        $update = $commandeDAO->updateStatutCommande($commande);
        if($update){
          if($commande->getStatutComm() == 'preparation'){
            email($user->getEmail(), 'BeelEAT | Votre commande est prête', 'Votre commande est prête', 'Bonjour '.$user->getPseudo().',', 'Votre commande numéro '.$id.' est prête. Vous avez 30 minutes pour venir la récupérer.');
          }
          header('Location: ../?page='.$before);
        } else {
          header('Location: ../?error=ERREUR$page='.$before);
        }
      }
    }
  }
