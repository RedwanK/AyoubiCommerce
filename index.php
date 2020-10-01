<?php
require_once './config/twig.php';

echo $twig->render('index.html', [ 'name' => 'One hell of a name' ]);