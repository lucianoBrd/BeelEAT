<?php
require_once(PATH_ENTITY.'ListeIngreComm.php');
require_once(PATH_ENTITY.'Ingredient.php');
require_once('DAO.php');
require_once('ProduitDAO.php');
class ListeIngreCommDAO extends DAO{

  public function getListeIngredientById($id){
    $requete = 'SELECT * FROM liste_ingre_comm JOIN ingredient ON liste_ingre_comm.id_ingre = ingredient.id_ingre WHERE id_comm = ?';
    $donnees = array($id);
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $ingreListe = array();
      foreach ($res as $ingredient) {
        $ingreListe[] = new Ingredient($ingredient['id_ingre'], $ingredient['nom_ingre'], $ingredient['stock_ingre'], $ingredient['date_ingre'], $ingredient['statut_ingre'], $ingredient['type_ingre']);
      }
      return $ingreListe;
    }
    else return null;
  }

  public function newListeIngreComm($listeIngreComm){
    $requete = "INSERT INTO liste_ingre_comm(id_ingre, id_comm)
                VALUES (?, ?)";
    $donnees = array($listeIngreComm->getIngreId(), $listeIngreComm->getCommId());
    $res = $this->queryInsert($requete, $donnees);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }

}
?>
