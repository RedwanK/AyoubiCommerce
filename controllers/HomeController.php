<?php

namespace App\Controller;

require_once 'AbstractController.php';

class HomeController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show() {
        echo $this->twig->render('index.html', [ 'name' => 'One hell of a name' ]);
    }
}
