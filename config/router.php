<?php

function routes($router) {
    $router->get('/product/:slug-:id', 'home:show', 'home');
    $router->get('/', 'home:show', 'home');

    /* Customers */
    $router->get('/', 'customers:connexion', 'connexion');

    return $router;
}
