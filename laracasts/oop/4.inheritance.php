<?php
//
//class Mother {
//
//    public function getEyeCount()
//    {
//        return 2;
//    }
//}
//
//class Child extends Mother {
//
//}
//
//var_dump((new Child)->getEyeCount()); // 2

//class Post extends Eloquent {
//
//}
//
//$post->save();
//$post->update();

class Shape {

}

class Square extends Shape {
    protected $length = 4;

    public function getArea()
    {
        return pow($this->length, 2);
    }
}

class Triangle extends Shape{
    protected $base = 4;
    protected $height = 7;

    // override the method of parent class
    public function getArea()
    {
        return .5 * $this->base * $this->height;
    }
}

class Circle extends Shape {

}

//echo (new square)->getArea();
//echo (new Triangle)-> getArea();
echo (new Circle)->getArea();