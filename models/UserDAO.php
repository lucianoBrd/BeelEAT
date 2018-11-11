<?php
require_once(PATH_ENTITY.'User.php');
require_once('DAO.php');
class UserDAO extends DAO{

  public function getUserByKeySecret($log){
    $requete = "SELECT * FROM users WHERE key_secret = ?";
    $donnees = array($log);
    $res = $this->queryRow($requete, $donnees);

    if($res)
    {
      return new User($res['id'], $res['admin'], $res['pseudo'], $res['email'], $res['password'], $res['creation_date'], $res['key_secret']);
    }
    else return null;
  }

  public function getNbUserByEmail($email){
    $requete = "SELECT count(*) as numberEmail FROM users WHERE email = ?";
    $donnees = array($email);
    $res = $this->queryRow($requete, $donnees);

    if($res)
    {
      return $res['numberEmail'];
    }
    else return 0;
  }

  public function getNbUserById($id){
    $requete = "SELECT * FROM users WHERE id = ?";
    $donnees = array($id);
    $res = $this->queryRow($requete, $donnees);

    if($res)
    {
      return new User($res['id'], $res['admin'], $res['pseudo'], $res['email'], $res['password'], $res['creation_date'], $res['key_secret']);
    }
    else return 0;
  }

  public function getUserByEmail($email){
    $requete = "SELECT * FROM users WHERE email = ?";
    $donnees = array($email);
    $res = $this->queryRow($requete, $donnees);

    if($res)
    {
      return new User($res['id'], $res['admin'], $res['pseudo'], $res['email'], $res['password'], $res['creation_date'], $res['key_secret']);
    }
    else return null;
  }

  public function newUser($user){
    $requete = "INSERT INTO users(pseudo, email, password, key_secret) VALUES (?, ?, ?, ?)";
    $donnees = array($user->getPseudo(), $user->getEmail(), $user->getPassword(), $user->getKeySecret());
    $res = $this->queryInsert($requete, $donnees);
    if($res == false){
      return false;
    } else {
      return true;
    }
  }
}
?>
