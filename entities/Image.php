<?php

class Image
{
  private $_img_size;

  private $_img_type;

  private $_img_name;

  private $_link;

  private $_produit_id;

  public function __construct($img_size, $img_type, $img_name, $link, $produit_id)
  {
    $this->_img_size = $img_size;
    $this->_img_type = $img_type;
    $this->_img_name = $img_name;
    $this->_link = $link;
    $this->_produit_id = $produit_id;
  }

  public function getSize() {
    return $this->_img_size;
  }

  public function setize($img_size){
    $this->_img_size = $img_size;
  }

  public function getType() {
    return $this->_img_type;
  }

  public function setType($img_type){
    $this->_img_type = $img_type;
  }

  public function getName() {
    return $this->_img_name;
  }

  public function setName($img_name){
    $this->_img_name = $img_name;
  }

  public function getLink() {
    return $this->_link;
  }

  public function setLink($link){
    $this->_link = $link;
  }

  public function getProdID() {
    return $this->_produit_id;
  }

  public function setProdID($produit_id){
    $this->_produit_id = $produit_id;
  }
}
