<?php

namespace App\Controller;

require_once 'config/twig.php';

abstract class AbstractController
{
    protected $twig;

    public function __construct()
    {
        $twigObj = new \Config\Twig\Twig();
        $this->twig = $twigObj->getTwig();
    }
}
