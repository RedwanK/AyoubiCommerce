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


function stripAccents(string $string){
    return strtr(utf8_decode($string), utf8_decode('àáâçèéêëïñôùûüÀÁÂÇÈÉÊËÏÑÔÙÛ'),'aaaceeeeinouuuAAACEEEEINOUU');
}

function slugify(string $string)
{
    $strippedString = stripAccents($string);
    $normalizedString = preg_replace('/\s+/', ' ', $strippedString);
    $slug = str_replace(' ','-', $normalizedString);
    return $slug;
}
