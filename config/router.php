<?php

function routes($router) {
    $router->get('/product/:slug-:id', 'home:show', 'home');
    $router->get('/', 'home:show', 'home');

    /* Customers */
    $router->get('/connexion', 'customers:connexion', 'connexion');
    $router->post('/connexion', 'customers:connexion', 'connexion');
    $router->get('/deconnexion', 'customers:deconnexion', 'deconnexion');

    return $router;
}
