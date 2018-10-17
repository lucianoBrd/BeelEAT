<?php


// Initialisation des paramètres du site
session_start();
require_once('./config/configuration.php');
require_once('./lib/foncBase.php');
require_once(PATH_TEXTES.LANG.'.php');
require(link.'src/connection.php');


//appel du controller
require_once(PATH_CONTROLLERS.'ingredient.php');

?>
