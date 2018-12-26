<?php

class ListeIngre
{
  private $_id_liste_ingre;

  private $_id_prod;

  private $_id_ingre;

  public function __construct($id_liste_ingre, $id_prod, $id_ingre)
  {
    $this->_id_liste_ingre = $id_liste_ingre;
    $this->_id_prod = $id_prod;
    $this->_id_ingre = $id_ingre;
  }

  public function getListeProdId() {
    return $this->_id_liste_ingre;
  }

  public function setListeProdId($id_liste_ingre){
    $this->_id_liste_ingre = $id_liste_ingre;
  }

  public function getProdId() {
    return $this->_id_prod;
  }

  public function setProdId($id_prod){
    $this->_id_prod = $id_prod;
  }

  public function getMenuId() {
    return $this->_id_ingre;
  }

  public function setMenuId($id_ingre){
    $this->_id_ingre = $id_ingre;
  }
}
