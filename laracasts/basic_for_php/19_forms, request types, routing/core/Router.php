<?php

class Router
{
    protected $routes = [];

    public static function load($file) // $file: routes.php
    {
        // static method 는 인스턴스를 생성하지 않는 global method.
        // 인스턴스 생성을 위해서는 new static (or new self)
        $router = new static;

        require $file;

        // return $this; static method 는 인스턴스를 생성하지 않으므로 $this 는 사용이 불가능 함.
        return $router;

    }

    public function define($routes)
    {
        $this->routes = $routes;
    }

    public function direct($uri)
    {
        // about/culture
        // 들어온 uri 와 매칭되는 key 값이 있는지를 프로퍼티 $routes 에서 검증
        if (array_key_exists($uri, $this->routes)) {
            return $this->routes[$uri];
        }

        // 존재하지 않을 경우 Throw
        throw new Exception('No route defined for this uri');
    }
}