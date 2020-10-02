<?php

namespace App\Controller;

require_once 'AbstractController.php';

class HomeController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show($slug) {
        echo $this->twig->render('index.html', [ 'name' => $slug ]);
    }
}
