<?php

class Ingredient
{
  private $_id_ingre;

  private $_nom_ingre;

  private $_stock_ingre;

  private $_date_ingre;

  private $_statut_ingre;

  private $_type_ingre;

  public function __construct($id_ingre, $nom_ingre, $stock_ingre, $date_ingre, $statut_ingre, $type_ingre)
  {
    $this->_id_ingre = $id_ingre;
    $this->_nom_ingre = strtolower($nom_ingre);
    $this->_stock_ingre = $stock_ingre;
    $this->_date_ingre = $date_ingre;
    $this->_statut_ingre = strtolower($statut_ingre);
    $this->_type_ingre = strtolower($type_ingre);
  }

  public function getIngreId() {
    return $this->_id_ingre;
  }

  public function setIngreId($id_ingre){
    $this->_id_ingre = $id_ingre;
  }

  public function getNom() {
    return ucfirst($this->_nom_ingre);
  }

  public function setNom($nom_ingre){
    $this->_nom_ingre = strtolower($nom_ingre);
  }

  public function getStock() {
    return $this->_stock_ingre;
  }

  public function setStock($stock_ingre){
    $this->_stock_ingre = $stock_ingre;
  }

  public function getDate() {
    return $this->_date_ingre;
  }

  public function setDate($date_ingre){
    $this->_date_ingre = $date_ingre;
  }

  public function getStatut() {
    return $this->_statut_ingre;
  }

  public function setStatut($statut_ingre){
    $this->_statut_ingre = strtolower($statut_ingre);
  }

  public function getType() {
    return $this->_type_ingre;
  }

  public function setType($type_ingre){
    $this->_type_ingre = strtolower($type_ingre);
  }
}
