<?php

class Produit
{
  private $_id_prod;

  private $_nom_prod;

  private $_stock_prod;

  private $_date_prod;

  private $_statut_prod;

  private $_type_prod;

  private $_prix_prod;

  public function __construct($id_prod, $nom_prod, $stock_prod, $date_prod, $statut_prod, $type_prod, $prix_prod)
  {
    $this->_id_prod = $id_prod;
    $this->_nom_prod = strtolower($nom_prod);
    $this->_stock_prod = $stock_prod;
    $this->_date_prod = $date_prod;
    $this->_statut_prod = strtolower($statut_prod);
    $this->_type_prod = strtolower($type_prod);
    $this->_prix_prod = $prix_prod;
  }

  public function getProdId() {
    return $this->_id_prod;
  }

  public function setProdId($id_prod){
    $this->_id_prod = $id_prod;
  }

  public function getNom() {
    return ucfirst($this->_nom_prod);
  }

  public function setNom($nom_prod){
    $this->_nom_prod = strtolower($nom_prod);
  }

  public function getStock() {
    return $this->_stock_prod;
  }

  public function setStock($stock_prod){
    $this->_stock_prod = $stock_prod;
  }

  public function getDate() {
    return $this->_date_prod;
  }

  public function setDate($date_prod){
    $this->_date_prod = $date_prod;
  }

  public function getStatut() {
    return $this->_statut_prod;
  }

  public function setStatut($statut_prod){
    $this->_statut_prod = strtolower($statut_prod);
  }

  public function getType() {
    return $this->_type_prod;
  }

  public function setType($type_prod){
    $this->_type_prod = strtolower($type_prod);
  }

  public function getPrix() {
    return $this->_prix_prod;
  }

  public function setPrix($prix_prod){
    $this->_prix_prod = $prix_prod;
  }
}
