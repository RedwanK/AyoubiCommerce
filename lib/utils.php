<?php

function getFlashMessage($message)
{
  $alert = array();
  switch($message)
  {
    case 'INCONNUE' :
      $alert['messageAlert'] = MESSAGE_INCONNUE;
      $alert['typeAlert'] = 'warning';
      break;
    case 'SUCCESS' :
      $alert['messageAlert'] = MESSAGE_SUCCESS;
      $alert['typeAlert'] = 'success';
      break;
    default :
      $alert['messageAlert'] = MESSAGE_ERREUR;
      $alert['typeAlert'] = 'danger';
  }
  return $alert;
}
