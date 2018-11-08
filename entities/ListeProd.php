<?php

class ListeProd
{
  private $_id_liste_prod;

  private $_id_prod;

  private $_id_menu;

  public function __construct($id_liste_prod, $id_prod, $id_menu)
  {
    $this->_id_liste_prod = $id_liste_prod;
    $this->_id_prod = $id_prod;
    $this->_id_menu = $id_menu;
  }

  public function getListeProdId() {
    return $this->_id_liste_prod;
  }

  public function setListeProdId($id_liste_prod){
    $this->_id_liste_prod = $id_liste_prod;
  }

  public function getProdId() {
    return $this->_id_prod;
  }

  public function setProdId($id_prod){
    $this->_id_prod = $id_prod;
  }

  public function getMenuId() {
    return $this->_id_menu;
  }

  public function setMenuId($id_menu){
    $this->_id_menu = $id_menu;
  }
}
