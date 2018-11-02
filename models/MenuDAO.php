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

}
?>
