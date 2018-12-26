<?php
require_once(PATH_ENTITY.'ListeIngre.php');
require_once(PATH_ENTITY.'Ingredient.php');
require_once('DAO.php');
require_once('ProduitDAO.php');
class ListeIngreDAO extends DAO{

  public function getListeIngredientById($id){
    $requete = 'SELECT * FROM liste_ingre JOIN ingredient ON liste_ingre.id_ingre = ingredient.id_ingre WHERE id_prod = ? and statut_ingre != "indisponible"';
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

  public function newListeIngre($prodListe){
    $produitDAO = new ProduitDAO();
    $requete = "INSERT INTO liste_ingre(id_prod, id_ingre)
                VALUES (?, ?)";

    $idProd = $produitDAO->getLastProduitID();
    foreach ($prodListe as $id)  {
      $donnees = array($idProd, $id);
      $res = $this->queryInsert($requete, $donnees);
    }
  }

}
?>
