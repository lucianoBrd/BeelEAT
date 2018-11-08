<?php
require_once(PATH_ENTITY.'Image.php');
require_once('DAO.php');
class ImageDAO extends DAO{

  public function getImageByProdId($id){
    $requete = "SELECT * FROM image WHERE produit_id = ?";
    $donnees = array($id);
    $res = $this->queryRow($requete, $donnees);

    if($res)
    {
      return new Image($res['img_size'], $res['img_type'], $res['img_name'], $res['link'], $res['produit_id']);
    }
    else return null;
  }

  public function newImage($image){
    $requete = "INSERT INTO image(img_size, img_type, img_name, link, produit_id)
                VALUES (?, ?, ?, ?, ?)";
    $donnees = array($image->getSize(), $image->getType(), $image->getName(), $image->getLink(), $image->getProdID());
    $res = $this->queryInsert($requete, $donnees);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }
}
?>
