<?php namespace Acme;

class Square implements Shape {
    public $width;
    public $height;

    function __construct($height, $width)
    {
        $this->height = $height;
        $this->width = $width;
    }

    public function area()
    {
        return $this->width * $this->height;
    }
}