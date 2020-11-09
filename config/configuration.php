<?php
require_once 'config/twig.php';
require_once 'config/env.php';

// Racine folders
define('PATH_CONTROLLERS', './controllers/');
define('PATH_ENTITY', './entities/');
define('PATH_ASSETS', './assets/');
define('PATH_LIB', './lib/');
define('PATH_MODELS', './models/');
define('PATH_VIEWS', './views/v_');
define('PATH_TEXTES', './languages/');
define('PATH_UTILS', './utils/');
define('PATH_CAPTCHA', './captcha/');

define('PATH_CSS', PATH_ASSETS . 'css/');
define('PATH_IMG', PATH_ASSETS . 'images/');
define('PATH_JS', PATH_ASSETS . 'js/');
define('PATH_FONT', PATH_ASSETS . 'fonts/');

/* Captcha */
const PUBLIC_KEY = '6LfdgNkZAAAAAHzy6VQV8w02h9ks1eniowUvMf4O';
const PRIVATE_KEY = '6LfdgNkZAAAAAPMlakzu3kJ_KXSGq5avIT3lUAJm';

require_once PATH_TEXTES . 'FR-fr.php';
require_once PATH_LIB . 'utils.php';

/* Controllers */
require_once 'controllers/HomeController.php';
require_once 'controllers/CustomersController.php';
