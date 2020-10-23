<?php

// Accès base de données
const DEV = FALSE;

const BD_HOST = !DEV?'' : 'localhost';
const BD_DBNAME = !DEV?'' : 'formation_members';
const BD_USER = !DEV?'' : 'root';
const BD_PWD = !DEV?'' : '';
const MAIL_LINK = !DEV?'https://beeleat.lucien-brd.com/' : 'https://localhost/';

// Langue du site
const LANG ='FR-fr';



//dossiers racines du site
define('PATH_CONTROLLERS','./controllers/c_');
define('PATH_CONTROLLERS_ADMIN','./controllersAdmin/c_');
define('PATH_ENTITY','./entities/');
define('PATH_ASSETS_ADMIN','./assetsAdmin/');
define('PATH_ASSETS','./assets/');
define('PATH_LIB','./lib/');
define('PATH_MODELS','./models/');
define('PATH_VIEWS','./views/v_');
define('PATH_VIEWS_ADMIN','./viewsAdmin/v_');
define('PATH_TEXTES','./languages/');
define('PATH_MAIL','./email/mailTest.php');
define('link', './');
