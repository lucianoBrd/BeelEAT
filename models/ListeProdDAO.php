<?php
require_once(PATH_ENTITY.'ListeProd.php');
require_once('DAO.php');
require_once('MenuDAO.php');
class ListeProdDAO extends DAO{

  public function newListeProd($menuListe){
    $menuDAO = new MenuDAO();
    $requete = "INSERT INTO liste_prod(id_prod, id_menu)
                VALUES (?, ?)";

    $idMenu = $menuDAO->getLastMenuID();
    foreach ($menuListe as $id)  {
      $donnees = array($id, $idMenu);
      $res = $this->queryInsert($requete, $donnees);
    }
  }

}
?>
