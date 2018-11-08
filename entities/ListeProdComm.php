<?php

class ListeProdComm
{
  private $_id_liste_prod_comm;

  private $_id_prod;

  private $_id_comm;

  public function __construct($id_liste_prod_comm, $id_prod, $id_comm)
  {
    $this->_id_liste_prod_comm = $id_liste_prod_comm;
    $this->_id_prod = $id_prod;
    $this->_id_comm = $id_comm;
  }

  public function getListeProdCommId() {
    return $this->_id_liste_prod_comm;
  }

  public function setListeProdCommId($id_liste_prod_comm){
    $this->_id_liste_prod_comm = $id_liste_prod_comm;
  }

  public function getProdId() {
    return $this->_id_prod;
  }

  public function setProdId($id_prod){
    $this->_id_prod = $id_prod;
  }

  public function getCommId() {
    return $this->_id_comm;
  }

  public function setCommId($id_comm){
    $this->_id_comm = $id_comm;
  }
}
