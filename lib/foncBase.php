<?php

function choixAlertAdmin($message)
{
  $alert = array();
  switch($message)
  {
    case 'INSERT' :
      $alert['messageAlert'] = INSERT;
      break;
    case 'ID' :
      $alert['messageAlert'] = ID;
      break;
    case 'INCOMPLET' :
        $alert['messageAlert'] = INCOMPLET;
        break;
    case 'IMAGE' :
      $alert['messageAlert'] = IMAGE;
      //$alert['classAlert'] = "success";
      break;
    case 'SUCCESS' :
      $alert['messageAlert'] = BRAVO;
      $alert['classAlert'] = "success";
      break;
    default :
      $alert['messageAlert'] = MESSAGE_ERREUR;
  }
  return $alert;
}

function choixAlert($message)
{
  $alert = array();
  switch($message)
  {
    case 'INCONNUE' :
      $alert['messageAlert'] = ERREUR;
      break;
    case 'COMMANDE_FALSE' :
      $alert['messageAlert'] = ERREUR_COMM;
      break;
    case 'EMAIL' :
      $alert['messageAlert'] = MAIL;
      break;
    case 'PASS' :
      $alert['messageAlert'] = MDP;
      break;
    case 'SUCCESS' :
      $alert['messageAlert'] = INSCRIPTION;
      $alert['classAlert'] = "success";
      break;
    case 'COMMANDE_TRUE' :
      $alert['messageAlert'] = COMMANDE;
      $alert['classAlert'] = "success";
      break;
    default :
      $alert['messageAlert'] = MESSAGE_ERREUR;
  }
  return $alert;
}
