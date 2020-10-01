<?php

function getFlashMessage($message)
{
  $alert = array();
  switch($message)
  {
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
