<?php

class Commande
{
  private $_id_comm;

  private $_date_comm;

  private $_user_comm;

  private $_prix_comm;

  private $_statut_comm;

  private $_menu_comm;

  private $_prod_comm;

  public function __construct($id_comm, $date_comm, $user_comm, $prix_comm, $statut_comm, $menu_comm, $prod_comm)
  {
    $this->_id_comm = $id_comm;
    $this->_date_comm = $date_comm;
    $this->_user_comm = $user_comm;
    $this->_prix_comm = $prix_comm;
    $this->_statut_comm = $statut_comm;
    $this->_menu_comm = $menu_comm;
    $this->_prod_comm = $prod_comm;
  }

  public function getCommId() {
    return $this->_id_comm;
  }

  public function setCommId($id_comm){
    $this->_id_comm = $id_comm;
  }

  public function getDateComm() {
    return $this->_date_comm;
  }

  public function setDateComm($date_comm){
    $this->_date_comm = $date_comm;
  }

  public function getUserComm() {
    return $this->_user_comm;
  }

  public function setUserCommm($user_comm){
    $this->_user_comm = $user_comm;
  }

  public function getPrixComm() {
    return $this->_prix_comm;
  }

  public function setPrixCOmm($prix_comm){
    $this->_prix_comm = $prix_comm;
  }

  public function getStatutComm() {
    return $this->_statut_comm;
  }

  public function setStatutComm($statut_comm){
    $this->_statut_comm = $statut_comm;
  }

  public function getMenuComm() {
    return $this->_menu_comm;
  }

  public function setMenuComm($menu_comm){
    $this->_menu_comm = $menu_comm;
  }

  public function getProdComm() {
    return $this->_prod_comm;
  }

  public function setProdComm($prod_comm){
    $this->_prod_comm = $prod_comm;
  }
}
