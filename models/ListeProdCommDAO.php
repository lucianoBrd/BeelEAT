<?php
require_once(PATH_ENTITY.'ListeProdComm.php');
require_once('DAO.php');
class ListeProdCommDAO extends DAO{

  public function newListeProdComm($listeProdComm){
    $requete = "INSERT INTO liste_prod_comm(id_prod, id_comm)
                VALUES (?, ?)";
    $donnees = array($listeProdComm->getProdId(), $listeProdComm->getCommId());
    $res = $this->queryInsert($requete, $donnees);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }

}
?>
