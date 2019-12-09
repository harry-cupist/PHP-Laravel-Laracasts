<?php
//
//abstract class Mailer {
//    public function send($to, $from, $body)
//    {
//
//    }
//}
//
//class UserMailer extends Mailer {
//    public function sendWelcomeEmail(User $user)
//    {
//        return $this->send($user->email);
//    }
//}

abstract class Shape {
    protected $color;

    public function __construct($color = 'red')
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    abstract protected function getArea();
}

class Square extends Shape {
    protected $length = 4;

    public function getArea()
    {
        return pow($this->length, 2);
    }
}

class Triangle extends Shape {
    protected $base = 4;
    protected $height = 7;

    public function getArea()
    {
        return .5 * $this->base * $this->height;
    }
}

class Circle extends shape {
    protected $radius = 5;

    public function getArea()
    {
        return pi() * pow($this->radius, 2);
    }
}

//echo (new Square)->getArea();
//echo (new Triangle)->getArea();
//echo (new Circle)->getArea();

var_dump((new Circle('blue'))->getColor());