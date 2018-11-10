<?php
require_once(PATH_ENTITY.'ListeProdComm.php');
require_once('DAO.php');
class ListeProdCommDAO extends DAO{

  public function getListeProdCommByIdComm($idComm){
    require_once(PATH_MODELS.'ProduitDAO.php');
    $produitDAO = new ProduitDAO();
    $requete = "SELECT * FROM liste_prod_comm WHERE id_comm = ?";
    $donnees = array($idComm);
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $commListe = array();
      $i=0;
      foreach ($res as $commande) {
        $commListe[$i] = $produitDAO->getProduitByIDJoinImage($commande['id_prod']);
        $i++;
      }
      return $commListe;
    }
    else return null;
  }

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
