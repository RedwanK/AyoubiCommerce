<?php

namespace Config\Twig;

spl_autoload_register(function ($classname) {
    $dirs = array (
        './lib/twig/'
    );

    foreach ($dirs as $dir) {
        $filename = $dir . str_replace('\\', '/', $classname) .'.php';
        if (file_exists($filename)) {
            require_once $filename;
            break;
        }
    }

});

class Twig
{
    public $twig;
    private $loader;

    public function __construct() {
        $this->loader = new \Twig\Loader\FilesystemLoader('templates');
        $this->twig = new \Twig\Environment($this->loader, [
            'cache' => 'var/cache',
            'debug' => true
        ]);
        $this->twig->addGlobal('session', $_SESSION);
    }

    public function getLoader() {
        return $this->loader;
    }

    public function getTwig() {
        return $this->twig;
    }
}
