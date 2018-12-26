<?php

class ListeIngreComm
{
  private $_id_liste_ingre;

  private $_id_comm;

  private $_id_ingre;

  public function __construct($id_liste_ingre, $id_comm, $id_ingre)
  {
    $this->_id_liste_ingre = $id_liste_ingre;
    $this->_id_comm = $id_comm;
    $this->_id_ingre = $id_ingre;
  }

  public function getListeCommId() {
    return $this->_id_liste_ingre;
  }

  public function setListeCommId($id_liste_ingre){
    $this->_id_liste_ingre = $id_liste_ingre;
  }

  public function getCommId() {
    return $this->_id_comm;
  }

  public function setCommId($id_comm){
    $this->_id_comm = $id_comm;
  }

  public function getIngreId() {
    return $this->_id_ingre;
  }

  public function setIngreId($id_ingre){
    $this->_id_ingre = $id_ingre;
  }
}
