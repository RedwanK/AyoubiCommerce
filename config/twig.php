<?php
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
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => 'cache',
]);