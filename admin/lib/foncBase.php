<?php

function choixAlert($message, $i = 0)
{
  $alert = array();
  switch($message)
  {
    case 'query' :
      $alert['messageAlert'] = ERREUR_QUERY;
      break;
    case 'url_non_valide' :
      $alert['messageAlert'] = TEXTE_PAGE_404;
      break;
    case 'id_non_valide' :
        $alert['messageAlert'] = ERREUR_ID;
        break;
    case 'selection' :
      $alert['messageAlert'] = $i.PHOTO_SELECTION;
      $alert['classAlert'] = "success";
      break;
    default :
      $alert['messageAlert'] = MESSAGE_ERREUR;
  }
  return $alert;
}
