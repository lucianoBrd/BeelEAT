<?php
require_once(PATH_ENTITY.'Commande.php');
require_once('DAO.php');
class CommandeDAO extends DAO{

  public function getLastCommandeID(){
    $requete = "SELECT * FROM commande WHERE id_comm=(SELECT MAX(id_comm) FROM commande)";
    $donnees = array();
    $res = $this->queryRow($requete, $donnees);
    if($res){
      return $res['id_comm'];
    }
    else return null;
  }

  public function newCommande($commande){
    $requete = "INSERT INTO commande(user_comm, prix_comm, statut_comm, menu_comm) VALUES (?, ?, ?, ?)";
    $donnees = array($commande->getUserComm(), $commande->getPrixComm(), $commande->getStatutComm(), $commande->getMenuComm());
    $res = $this->queryInsert($requete, $donnees);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }
}
?>
