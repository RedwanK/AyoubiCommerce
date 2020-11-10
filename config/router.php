<?php

function routes($router) {
    $router->get('/product/:slug-:id', 'home:show', 'home');
    $router->get('/', 'home:show', 'home');

    /* Customers */
    $router->get('/connexion', 'customers:connexion', 'connexion');
    $router->post('/connexion', 'customers:connexion', 'connexion');
    $router->get('/deconnexion', 'customers:deconnexion', 'deconnexion');
    $router->get('/creer-compte', 'customers:register', 'register');
    $router->post('/creer-compte', 'customers:register', 'register');
    /* Basket */
    $router->get('/panier', 'basket:view', 'panier');
    $router->post('/ajout-pannier', 'basket:add', 'add');
    $router->post('/ajout-pannier-api', 'basket:addApi', 'addApi');

    return $router;
}
