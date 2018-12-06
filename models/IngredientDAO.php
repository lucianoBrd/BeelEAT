<?php
require_once(PATH_ENTITY.'Ingredient.php');
require_once('DAO.php');
class IngredientDAO extends DAO{

  public function getIngredient(){
    $requete = "SELECT * FROM ingredient ORDER BY id_ingre DESC";
    $donnees = array();
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $ingreListe = array();
      $i = 0;
      foreach ($res as $ingredient) {
        $ingreListe[$i] = new Ingredient($ingredient['id_ingre'], $ingredient['nom_ingre'], $ingredient['stock_ingre'], $ingredient['date_ingre'], $ingredient['statut_ingre']);
        $i++;
      }
      return $ingreListe;
    }
    else return null;
  }

  public function getIngredientByID($id){
    $requete = "SELECT * FROM ingredient WHERE id_ingre = ?";
    $donnees = array($id);
    $res = $this->queryRow($requete, $donnees);

    if($res)
    {
      return new Ingredient($res['id_ingre'], $res['nom_ingre'], $res['stock_ingre'], $res['date_ingre'], $res['statut_ingre']);
    }
    else return null;
  }

  public function getIngredientDispo(){
    $requete = 'SELECT * FROM ingredient WHERE statut_ingre = "disponible" or statut_ingre = "publie" ORDER BY id_ingre DESC';
    $donnees = array();
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $ingreListe = array();
      $i = 0;
      foreach ($res as $ingredient) {
        $ingreListe[$i] = new Ingredient($ingredient['id_ingre'], $ingredient['nom_ingre'], $ingredient['stock_ingre'], $ingredient['date_ingre'], $ingredient['statut_ingre']);
        $i++;
      }
      return $prodListe;
    }
    else return null;
  }

  public function getLastIngredientID(){
    $requete = "SELECT * FROM ingredient WHERE id_ingre=(SELECT MAX(id_ingre) FROM ingredient)";
    $donnees = array();
    $res = $this->queryRow($requete, $donnees);
    if($res){
      return $res['id_ingre'];
    }
    else return null;
  }

  public function newIngredient($ingredient){
    $requete = "INSERT INTO ingredient(nom_ingre, stock_ingre, statut_ingre)
                VALUES (?, ?, ?)";
    $donnees = array($ingredient->getNom(), $ingredient->getStock(), $ingredient->getStatut());
    $res = $this->queryInsert($requete, $donnees);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }

  public function updateIngredient($ingredient){
    $requete = "UPDATE ingredient SET nom_ingre = ?, stock_ingre = ?, statut_ingre = ?
                WHERE id_ingre = ?";
    $donnees = array($ingredient->getNom(), $ingredient->getStock(), $ingredient->getStatut(), $ingredient->getIngreId());
    $res = $this->queryInsert($requete, $donnees);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }

  public function decrementIngredient($id){
    $requete = "UPDATE ingredient SET stock_ingre = stock_ingre-1 WHERE id_ingre = ?";
    $donnees = array($id);
    $res = $this->queryInsert($requete, $donnees);
    $this->statutIngredient($id);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }

  public function statutIngredient($id){
    $donnees = array($id);
    $ingredient = $this->getIngredientByID($id);
    if($ingredient->getStock() <= 1){
      $requete = 'UPDATE ingredient SET statut_ingre = "indisponible" WHERE id_ingre = ?';
      $res = $this->queryInsert($requete, $donnees);
    }
    if($ingredient->getStock() < 5){
      require_once(PATH_MAIL);
      email('lucien.burdet@gmail.com', 'BeelEAT | Stock Bas', 'Alerte Stock Bas', 'Bonjour Admin,', 'Attention, plus que '.$ingredient->getStock().' '.$ingredient->getNom().' en stock.');
    }
  }
}
?>
