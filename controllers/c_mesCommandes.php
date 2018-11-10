<?php
require_once(PATH_MODELS.'CommandeDAO.php');
$commandeDAO = new CommandeDAO();

$listeComm = $commandeDAO->getCommandeByUserId($_SESSION['id']);
require_once(PATH_VIEWS.$page.'.php');
