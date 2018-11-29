<?php
require_once(PATH_ENTITY.'ListeProd.php');
require_once(PATH_ENTITY.'Produit.php');
require_once(PATH_ENTITY.'Image.php');
require_once('DAO.php');
require_once('MenuDAO.php');
class ListeProdDAO extends DAO{

  public function getListeProduitById($id){
    require_once('ImageDAO.php');
    $imageDAO = new ImageDAO();
    $requete = 'SELECT * FROM liste_prod JOIN produit ON liste_prod.id_prod = produit.id_prod WHERE id_menu = ? and statut_prod != "indisponible"';
    $donnees = array($id);
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $prodListe = array();
      $i = 0;
      foreach ($res as $produit) {
        $prodListe[$i][0] = new Produit($produit['id_prod'], $produit['nom_prod'], $produit['stock_prod'], $produit['date_prod'], $produit['statut_prod'], $produit['type_prod'], $produit['prix_prod']);
        $image = $imageDAO->getImageByProdId($prodListe[$i][0]->getProdId());
        if($image == null){
          $prodListe[$i][1] = new Image(null, null, $prodListe[$i][0]->getNom(), 'assets/images/section-1.jpg', null);
        } else {
          $prodListe[$i][1] = $image;
        }
        $i++;
      }
      return $prodListe;
    }
    else return null;
  }

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
