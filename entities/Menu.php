<?php

class Menu
{
  private $_id_menu;

  private $_nom_menu;

  private $_date_menu;

  private $_statut_menu;

  private $_prix_menu;

  public function __construct($id_menu, $nom_menu, $date_menu, $statut_menu, $prix_menu)
  {
    $this->_id_menu = $id_menu;
    $this->_nom_menu = strtolower($nom_menu);
    $this->_date_menu = $date_menu;
    $this->_statut_menu = strtolower($statut_menu);
    $this->_prix_menu = $prix_menu;
  }

  public function getMenuId() {
    return $this->_id_menu;
  }

  public function setMenuId($id_menu){
    $this->_id_menu = $id_menu;
  }

  public function getNom() {
    return ucfirst($this->_nom_menu);
  }

  public function setNom($nom_menu){
    $this->_nom_menu = strtolower($nom_menu);
  }

  public function getDate() {
    return $this->_date_menu;
  }

  public function setDate($date_menu){
    $this->_date_menu = $date_menu;
  }

  public function getStatut() {
    return $this->_statut_menu;
  }

  public function setStatut($statut_menu){
    $this->_statut_menu = strtolower($statut_menu);
  }

  public function getPrix() {
    return $this->_prix_menu;
  }

  public function setPrix($prix_menu){
    $this->_prix_menu = $prix_menu;
  }
}
