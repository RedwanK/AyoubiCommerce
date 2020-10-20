<?php

/**
 * Get message, type of message and color
 */
function getFlashMessage($message)
{
    $alert = array();
    switch ($message) {
    case 'INCONNUE':
      $alert['type'] = 'INCONNUE';
      $alert['message'] = MESSAGE_INCONNUE;
      $alert['color'] = 'red';
      break;
    case 'USERNAME_TAKEN':
      $alert['type'] = 'USERNAME_TAKEN';
      $alert['message'] = MESSAGE_USERNAME_TAKEN;
      $alert['color'] = 'red';
      break;
    case 'PASSWORDS_NOT_SAME':
      $alert['type'] = 'PASSWORDS_NOT_SAME';
      $alert['message'] = MESSAGE_PASSWORDS_NOT_SAME;
      $alert['color'] = 'red';
      break;
    case 'INSERT':
      $alert['type'] = 'INSERT';
      $alert['message'] = MESSAGE_INSERT;
      $alert['color'] = 'red';
      break;
    case 'INSERT_SUCCESS':
      $alert['type'] = 'INSERT_SUCCESS';
      $alert['message'] = MESSAGE_INSERT_SUCCESS;
      $alert['color'] = 'green';
      break;
    case 'SUCCESS':
      $alert['type'] = 'SUCCESS';
      $alert['message'] = MESSAGE_SUCCESS;
      $alert['color'] = 'green';
      break;
    default:
      $alert['type'] = 'default';
      $alert['message'] = MESSAGE_ERREUR;
      $alert['color'] = 'red';
  }
    return $alert;
}

/**
 * Check if message exist
 * If exist, create alert
 * Return null if not exist
 */
function checkMessage()
{
    $alert = null;
    if (isset($_GET['message'])) {
        $message = htmlspecialchars($_GET['message']);
        $alert = getFlashMessage($message);
    }
    return $alert;
}

/**
 * Get GET parameter
 * Return null if not exist
 */
function getParameter($name)
{
    $parameter = null;
    if (isset($_GET[$name])) {
        $parameter = htmlspecialchars($_GET[$name]);
    }
    return $parameter;
}

function stripAccents(string $string)
{
    return strtr(utf8_decode($string), utf8_decode('àáâçèéêëïñôùûüÀÁÂÇÈÉÊËÏÑÔÙÛ'), 'aaaceeeeinouuuAAACEEEEINOUU');
}

function slugify(string $string)
{
    $strippedString = stripAccents($string);
    $normalizedString = preg_replace('/\s+/', ' ', $strippedString);
    $slug = str_replace(' ', '-', $normalizedString);
    return $slug;
}
