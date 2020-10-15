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

define('PATH_CSS', PATH_ASSETS . 'css/');
define('PATH_IMG', PATH_ASSETS . 'images/');
define('PATH_JS', PATH_ASSETS . 'js/');
define('PATH_FONT', PATH_ASSETS . 'fonts/');

require_once PATH_LIB . 'utils.php';
require_once PATH_TEXTES . 'FR-fr.php';

/* Controllers */
require_once 'controllers/HomeController.php';
require_once 'controllers/CustomersController.php';
