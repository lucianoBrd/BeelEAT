<?php

  if(!isset($_SESSION['connect'])){
    header('location: '.link);
  } elseif($_SESSION['admin'] == true) {
    require_once(PATH_MODELS.'CommandeDAO.php');
    $commandeDAO = new CommandeDAO();

    $listeComm = $commandeDAO->getCommandePrepa();
    if(isset($_GET['error'])){
			$error = htmlspecialchars($_GET['error']);
      $alert = choixAlertAdmin($error);
		}
    require_once(PATH_VIEWS_ADMIN.$page.'.php');
  }
