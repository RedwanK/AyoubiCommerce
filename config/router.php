<?php

function routes($router) {
    $router->get('/product/:slug', 'home:show', 'home');

    return $router;
}
