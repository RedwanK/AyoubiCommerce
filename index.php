<?php
session_start();
require_once('./config/configuration.php');
require_once ('./config/router.php');
require_once ('./router/Router.php');


$router = new \App\Router\Router($_SERVER['REQUEST_URI']);

$router = routes($router);

$router->run();

