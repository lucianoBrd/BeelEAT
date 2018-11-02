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
    default :
      $alert['messageAlert'] = MESSAGE_ERREUR;
  }
  return $alert;
}
