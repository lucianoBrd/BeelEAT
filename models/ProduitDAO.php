<?php
require_once(PATH_ENTITY.'Produit.php');
require_once(PATH_ENTITY.'Image.php');
require_once('DAO.php');
class ProduitDAO extends DAO{

  public function getProduit(){
    $requete = "SELECT * FROM produit ORDER BY id_prod DESC";
    $donnees = array();
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $prodListe = array();
      $i = 0;
      foreach ($res as $produit) {
        $prodListe[$i] = new Produit($produit['id_prod'], $produit['nom_prod'], $produit['stock_prod'], $produit['date_prod'], $produit['statut_prod'], $produit['type_prod'], $produit['prix_prod']);
        $i++;
      }
      return $prodListe;
    }
    else return null;
  }

  public function getProduitDispo(){
    $requete = 'SELECT * FROM produit WHERE statut_prod = "disponible" or statut_prod = "publie" ORDER BY id_prod DESC';
    $donnees = array();
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $prodListe = array();
      $i = 0;
      foreach ($res as $produit) {
        $prodListe[$i] = new Produit($produit['id_prod'], $produit['nom_prod'], $produit['stock_prod'], $produit['date_prod'], $produit['statut_prod'], $produit['type_prod'], $produit['prix_prod']);
        $i++;
      }
      return $prodListe;
    }
    else return null;
  }

  public function getProduitByIDJoinImage($id){
    $requete = "SELECT * FROM produit LEFT JOIN image ON image.produit_id = produit.id_prod WHERE id_prod=?";
    $donnees = array($id);
    $res = $this->queryRow($requete, $donnees);

    if($res)
    {
      $prodImg = array();
      $prodImg[0] = new Produit($res['id_prod'], $res['nom_prod'], $res['stock_prod'], $res['date_prod'], $res['statut_prod'], $res['type_prod'], $res['prix_prod']);
      $prodImg[1] = new Image(null, null, $res['img_name'], $res['link'], null);
      return $prodImg;
    }
    else return null;
  }

  public function getProduitJoinImage(){
    $requete = 'SELECT * FROM produit JOIN image ON image.produit_id = produit.id_prod WHERE statut_prod = "publie"';
    $donnees = array();
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $prodImgListe = array();
      $i = 0;
      foreach ($res as $produit) {
        $prodImgListe[$i][0] = new Produit($produit['id_prod'], $produit['nom_prod'], $produit['stock_prod'], $produit['date_prod'], $produit['statut_prod'], $produit['type_prod'], $produit['prix_prod']);
        if($produit['link'] == null){
          $linkImg = 'assets/images/section-1.jpg';
        } else {
          $linkImg = $produit['link'];
        }
        $prodImgListe[$i][1] = new Image(null, null, $produit['nom_prod'], $linkImg, null);
        $i++;
      }
      return $prodImgListe;
    }
    else return null;
  }

  public function getLastProduitID(){
    $requete = "SELECT * FROM produit WHERE id_prod=(SELECT MAX(id_prod) FROM produit)";
    $donnees = array();
    $res = $this->queryRow($requete, $donnees);
    if($res){
      return $res['id_prod'];
    }
    else return null;
  }

  public function newProduit($produit){
    $requete = "INSERT INTO produit(nom_prod, stock_prod, statut_prod, type_prod, prix_prod)
                VALUES (?, ?, ?, ?, ?)";
    $donnees = array($produit->getNom(), $produit->getStock(), $produit->getStatut(), $produit->getType(), $produit->getPrix());
    $res = $this->queryInsert($requete, $donnees);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }

  public function decrementProduit($id){
    $requete = "UPDATE produit SET stock_prod = stock_prod-1 WHERE id_prod = ?";
    $donnees = array($id);
    $res = $this->queryInsert($requete, $donnees);
    $this->statutProduit($id);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }

  public function statutProduit($id){
    $donnees = array($id);
    $produit = $this->getProduitByIDJoinImage($id);
    if($produit[0]->getStock() == 1){
      $requete = 'UPDATE produit SET statut_prod = "indisponible" WHERE id_prod = ?';
      $res = $this->queryInsert($requete, $donnees);
    }
    if($produit[0]->getStock() < 5){
      require_once(PATH_MAIL);
      email('lucien.burdet@gmail.com', 'BeelEAT | Stock Bas', 'Alerte Stock Bas', 'Bonjour Admin,', 'Attention, plus que '.$produit[0]->getStock().' '.$produit[0]->getNom().' en stock.');
    }
  }
}
?>
