<?php
require_once(PATH_ENTITY.'Menu.php');
require_once('DAO.php');
class MenuDAO extends DAO{

  public function getMenu(){
    $requete = "SELECT * FROM menu ORDER BY id_menu DESC";
    $donnees = array();
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $menuListe = array();
      $i = 0;
      foreach ($res as $menu) {
        $menuListe[$i] = new Menu($menu['id_menu'], $menu['nom_menu'], $menu['date_menu'], $menu['statut_menu'], $menu['prix_menu']);
        $i++;
      }
      return $menuListe;
    }
    else return null;
  }

  public function getMenuById($id){
    $requete = "SELECT * FROM menu WHERE id_menu = ?";
    $donnees = array($id);
    $res = $this->queryRow($requete, $donnees);

    if($res)
    {
      return new Menu($res['id_menu'], $res['nom_menu'], $res['date_menu'], $res['statut_menu'], $res['prix_menu']);
    }
    else return null;
  }

  public function getMenuJoinImage(){
    $requete = 'SELECT * FROM menu LEFT JOIN image ON image.produit_id = id_menu WHERE statut_menu = "publie"';
    $donnees = array();
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $menuImgListe = array();
      $i = 0;
      foreach ($res as $menu) {
        $menuImgListe[$i][0] = new Menu($menu['id_menu'], $menu['nom_menu'], $menu['date_menu'], $menu['statut_menu'], $menu['prix_menu']);
        if($menu['link'] == null){
          $linkImg = 'assets/images/section-1.jpg';
        } else {
          $linkImg = $menu['link'];
        }
        $menuImgListe[$i][1] = new Image(null, null, $menu['nom_menu'], $linkImg, null);
        $i++;
      }
      return $menuImgListe;
    }
    else return null;
  }

  public function getMenuJoinImageById($id){
    $requete = 'SELECT * FROM menu LEFT JOIN image ON image.produit_id = id_menu WHERE id_menu = ?';
    $donnees = array($id);
    $res = $this->queryRow($requete, $donnees);

    if($res)
    {
      $menuImgListe = array();
        $menuImgListe[0] = new Menu($res['id_menu'], $res['nom_menu'], $res['date_menu'], $res['statut_menu'], $res['prix_menu']);
        if($res['link'] == null){
          $linkImg = 'assets/images/section-1.jpg';
        } else {
          $linkImg = $res['link'];
        }
        $menuImgListe[1] = new Image(null, null, $res['nom_menu'], $linkImg, null);
      return $menuImgListe;
    }
    else return null;
  }

  public function getLastMenuID(){
    $requete = "SELECT * FROM menu WHERE id_menu=(SELECT MAX(id_menu) FROM menu)";
    $donnees = array();
    $res = $this->queryRow($requete, $donnees);
    if($res){
      return $res['id_menu'];
    }
    else return null;
  }

  public function newMenu($menu){
    $requete = "INSERT INTO menu(nom_menu, statut_menu, prix_menu)
                VALUES (?, ?, ?)";
    $donnees = array($menu->getNom(), $menu->getStatut(), $menu->getPrix());
    $res = $this->queryInsert($requete, $donnees);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }

  public function updateMenu($menu){
    $requete = "UPDATE menu SET nom_menu = ?, statut_menu = ?, prix_menu = ?
                WHERE id_menu = ?";
    $donnees = array($menu->getNom(), $menu->getStatut(), $menu->getPrix(), $menu->getMenuId());
    $res = $this->queryInsert($requete, $donnees);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }

}
?>
