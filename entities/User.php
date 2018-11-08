<?php

class User
{
  private $_id;

  private $_admin;

  private $_pseudo;

  private $_email;

  private $_password;

  private $_creation_date;

  private $_key_secret;

  public function __construct($id, $admin, $pseudo, $email, $password, $creation_date, $key_secret)
  {
    $this->_id = $id;
    $this->_admin = $admin;
    $this->_pseudo = strtolower($pseudo);
    $this->_email = $email;
    $this->_password = $password;
    $this->_creation_date = $creation_date;
    $this->_key_secret = $key_secret;
  }

  public function getId() {
    return $this->_id;
  }

  public function setId($id){
    $this->_id = $id;
  }

  public function getAdmin() {
    return $this->_admin;
  }

  public function setAdmin($admin){
    $this->_admin = $admin;
  }

  public function getPseudo() {
    return ucfirst($this->_pseudo);
  }

  public function setPseudo($pseudo){
    $this->_pseudo = strtolower($pseudo);
  }

  public function getEmail() {
    return $this->_email;
  }

  public function setEmail($email){
    $this->_email = $email;
  }

  public function getPassword() {
    return $this->_password;
  }

  public function setPassword($password){
    $this->_password = $password;
  }

  public function getCreationDate() {
    return $this->_creation_date;
  }

  public function setCreationDate($creation_date){
    $this->_creation_date = $creation_date;
  }

  public function getKeySecret() {
    return $this->_key_secret;
  }

  public function setKeySecret($key_secret){
    $this->_key_secret = $key_secret;
  }
}
