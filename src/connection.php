<?php
  try {
    //$db = new PDO('mysql:host=emiliengzs321.mysql.db;dbname=emiliengzs321;charset=utf8', 'emiliengzs321', 'Capiitainecool01');
    $db = new PDO('mysql:host=localhost;dbname=formation_members;charset=utf8', 'root', '');
  } catch(Exception $e){
    die('Erreur : '.$e->getMessage());
  }
?>
