<?php
require_once(PATH_ENTITY.'Commande.php');
require_once('DAO.php');
class CommandeDAO extends DAO{

  public function getLastCommandeID(){
    $requete = "SELECT * FROM commande WHERE id_comm=(SELECT MAX(id_comm) FROM commande)";
    $donnees = array();
    $res = $this->queryRow($requete, $donnees);
    if($res){
      return $res['id_comm'];
    }
    else return null;
  }

  public function getCommandeByUserId($userId){
    require_once(PATH_MODELS.'ProduitDAO.php');
    require_once(PATH_MODELS.'MenuDAO.php');
    require_once(PATH_MODELS.'ListeProdCommDAO.php');
    require_once(PATH_MODELS.'ListeIngreCommDAO.php');
    $menuDAO = new MenuDAO();
    $produitDAO = new ProduitDAO();
    $listeProdCommDAO = new ListeProdCommDAO();
    $listeIngreCommDAO = new ListeIngreCommDAO();

    $requete = "SELECT * FROM commande WHERE user_comm = ? ORDER BY id_comm DESC";
    $donnees = array($userId);
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $commListe = array();
      $i = 0;
      foreach ($res as $commande) {
        $commListe[$i][0] = new Commande($commande['id_comm'], $commande['date_comm'], $commande['user_comm'], $commande['prix_comm'], $commande['statut_comm'], $commande['menu_comm'], $commande['prod_comm']);
        if($commande['prod_comm'] == null){
          $commListe[$i][1] = $menuDAO->getMenuById($commande['menu_comm']);
          $commListe[$i][2] = $listeProdCommDAO->getListeProdCommByIdComm($commande['id_comm']);
          $commListe[$i][3] = $listeIngreCommDAO->getListeIngredientById($commande['id_comm']);
        } else {
          $commListe[$i][1] = $produitDAO->getProduitByIDJoinImage($commande['prod_comm']);
          $commListe[$i][2] = $listeIngreCommDAO->getListeIngredientById($commande['id_comm']);
        }
        $i++;
      }
      return $commListe;
    }
    else return null;
  }

  public function getCommande(){
    require_once(PATH_MODELS.'ProduitDAO.php');
    require_once(PATH_MODELS.'MenuDAO.php');
    require_once(PATH_MODELS.'ListeProdCommDAO.php');
    require_once(PATH_MODELS.'UserDAO.php');
    require_once(PATH_MODELS.'ListeIngreCommDAO.php');
    $menuDAO = new MenuDAO();
    $produitDAO = new ProduitDAO();
    $listeProdCommDAO = new ListeProdCommDAO();
    $userDAO = new UserDAO();
    $listeIngreCommDAO = new ListeIngreCommDAO();

    $requete = "SELECT * FROM commande ORDER BY statut_comm ASC, id_comm DESC";
    $donnees = array();
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $commListe = array();
      $i = 0;
      foreach ($res as $commande) {
        $commListe[$i][0] = new Commande($commande['id_comm'], $commande['date_comm'], $commande['user_comm'], $commande['prix_comm'], $commande['statut_comm'], $commande['menu_comm'], $commande['prod_comm']);
        if($commande['prod_comm'] == null){
          $commListe[$i][1] = $menuDAO->getMenuById($commande['menu_comm']);
          $commListe[$i][2] = $listeProdCommDAO->getListeProdCommByIdComm($commande['id_comm']);
          $commListe[$i][3] = $userDAO->getNbUserById($commande['user_comm']);
          $commListe[$i][4] = $listeIngreCommDAO->getListeIngredientById($commande['id_comm']);
        } else {
          $commListe[$i][1] = $produitDAO->getProduitByIDJoinImage($commande['prod_comm']);
          $commListe[$i][2] = $userDAO->getNbUserById($commande['user_comm']);
          $commListe[$i][3] = $listeIngreCommDAO->getListeIngredientById($commande['id_comm']);
        }
        $i++;
      }
      return $commListe;
    }
    else return null;
  }

  public function getCommandePrepa(){
    require_once(PATH_MODELS.'ProduitDAO.php');
    require_once(PATH_MODELS.'MenuDAO.php');
    require_once(PATH_MODELS.'ListeProdCommDAO.php');
    require_once(PATH_MODELS.'UserDAO.php');
    require_once(PATH_MODELS.'ListeIngreCommDAO.php');
    $menuDAO = new MenuDAO();
    $produitDAO = new ProduitDAO();
    $listeProdCommDAO = new ListeProdCommDAO();
    $userDAO = new UserDAO();
    $listeIngreCommDAO = new ListeIngreCommDAO();

    $requete = 'SELECT * FROM commande WHERE statut_comm="preparation" ORDER BY id_comm ASC';
    $donnees = array();
    $res = $this->queryAll($requete, $donnees);

    if($res)
    {
      $commListe = array();
      $i = 0;
      foreach ($res as $commande) {
        $commListe[$i][0] = new Commande($commande['id_comm'], $commande['date_comm'], $commande['user_comm'], $commande['prix_comm'], $commande['statut_comm'], $commande['menu_comm'], $commande['prod_comm']);
        if($commande['prod_comm'] == null){
          $commListe[$i][1] = $menuDAO->getMenuById($commande['menu_comm']);
          $commListe[$i][2] = $listeProdCommDAO->getListeProdCommByIdComm($commande['id_comm']);
          $commListe[$i][3] = $userDAO->getNbUserById($commande['user_comm']);
          $commListe[$i][4] = $listeIngreCommDAO->getListeIngredientById($commande['id_comm']);
        } else {
          $commListe[$i][1] = $produitDAO->getProduitByIDJoinImage($commande['prod_comm']);
          $commListe[$i][2] = $userDAO->getNbUserById($commande['user_comm']);
          $commListe[$i][3] = $listeIngreCommDAO->getListeIngredientById($commande['id_comm']);
        }
        $i++;
      }
      return $commListe;
    }
    else return null;
  }

  public function getCommandeById($id){
    $requete = "SELECT * FROM commande WHERE id_comm = ?";
    $donnees = array($id);
    $res = $this->queryRow($requete, $donnees);

    if($res)
    {
      return new Commande($res['id_comm'], $res['date_comm'], $res['user_comm'], $res['prix_comm'], $res['statut_comm'], $res['menu_comm'], $res['prod_comm']);
    }
    else return null;
  }

  public function updateStatutCommande($commande){
    $requete = "UPDATE commande SET statut_comm = ? WHERE id_comm = ?";
    if($commande->getStatutComm() == "preparation"){
      $statut = "attente_recuperation";
    } elseif($commande->getStatutComm() == "attente_recuperation"){
      $statut = "termine";
    }
    $donnees = array($statut, $commande->getCommId());
    $res = $this->queryInsert($requete, $donnees);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }

  public function newCommande($commande){
    $requete = "INSERT INTO commande(user_comm, prix_comm, statut_comm, menu_comm, prod_comm) VALUES (?, ?, ?, ?, ?)";
    $donnees = array($commande->getUserComm(), $commande->getPrixComm(), $commande->getStatutComm(), $commande->getMenuComm(), $commande->getProdComm());
    $res = $this->queryInsert($requete, $donnees);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }
}
?>
