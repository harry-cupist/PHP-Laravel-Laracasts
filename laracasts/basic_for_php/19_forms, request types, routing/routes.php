<?php

$router->define([
    '' => 'controllers/index.php',
    'about' => 'controllers/about.php',
    'about/culture' => 'controllers/about-culture.php',
    'contact' => 'controllers/contact.php',
    'names' => 'controllers/add-name.php',
]);

//$router->define('', 'controllers/index.php');
//$router->define('about', 'controllers/index.php');
// Router::define('', 'controllers/index.php');
//$router->define('', 'controllers/index.php');
