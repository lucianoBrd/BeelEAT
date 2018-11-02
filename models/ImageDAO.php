<?php
require_once(PATH_ENTITY.'Image.php');
require_once('DAO.php');
class ImageDAO extends DAO{


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
