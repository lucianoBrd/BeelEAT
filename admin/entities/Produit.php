<?php

class Produit
{
  private $_id_prod;

  private $_nom_prod;

  private $_type_prod;

  public function __construct($id_prod, $nom_prod, $type_prod)
  {
    $this->_id_prod = $id_prod;
    $this->_nom_prod = $nom_prod;
    $this->_type_prod = $type_prod;

  }

  public function getProdId() {
    return $this->_id_prod;
  }

  public function setProdId($id_prod){
    $this->_id_prod = $id_prod;
  }

  public function getNom() {
    return $this->_nom_prod;
  }

  public function setNom($nom_prod){
    $this->_nom_prod = $nom_prod;
  }

  public function getType() {
    return $this->_type_prod;
  }

  public function setType($type_prod){
    $this->_type_prod = $type_prod;
  }
}
