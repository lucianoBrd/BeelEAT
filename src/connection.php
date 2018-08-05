<?php
  try {
    $db = new PDO('mysql:host=emiliengzs321.mysql.db;dbname=emiliengzs321;charset=utf8', 'emiliengzs321', 'Capiitainecool01');
  } catch(Exception $e){
    die('Erreur : '.$e->getMessage());
  }
?>
