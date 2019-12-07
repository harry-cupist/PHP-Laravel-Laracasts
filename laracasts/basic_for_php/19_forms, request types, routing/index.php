<?php

require 'core/bootstrap.php';

$router = new Router; // Router 클래스는 bootstrap과 연결되어 있음.
require 'routes.php'; // routes (uri list)를 불러옴

$uri = trim($_SERVER['REQUEST_URI'],'/');

require $router->direct($uri); // Router 클래스의 메서드: routes 존재 여부 검사

//die(var_dump($app));



// beneath Chaining can be described as below;
//$router = Router::load('routes.php');
//var_dump($router);
//require $router-> direct($uri);

//require Router::load('routes.php')
//    ->direct(Request::uri());