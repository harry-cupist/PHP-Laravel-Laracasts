## Open-Closed

> Open-Closed: Entities(class, method, function etc..) should be open for extension, but closed for modification

- open for extension:  it should be simple to change the behavior of a particular entity (class)

- closed for modification: **Goal** (very difficult to follow perfectly). something you should strive for its goal. **Change behavior without modifying original source code** .



#### modify behavior by doing it from extension

회사의 보스가 사각형을 준비하라고 지시를 내렸음

- 이에 따라 `squre` 이라는 클래스 생성

이후, 보스가 사각형의 면적을 계산해야한다고 지시를 내림 

- Single Responsibility Principle에 따라, 면적만을 계산하는 클래스를 따로 생성
- 가장 심플한 형태로 사각형들을 배열로 받아 면적의 합을 누적으로 저장시킴

```php
<?php namespace Acme;

class Square {
    public $width;
    public $height;

    function __construct($height, $width)
    {
        $this->height = $height;
        $this->width = $width;
    }
}
```

```php
<?php namespace Acme;

class AreaCalculator {

    public function calculate($squares)
    {
        $area = 0;
        foreach ($squares as $square)
        {
            $area += $square->width * $square->height;
        }
      
      	return $area;
    }
}
```



그리고, 보스가 원에 대해서도 준비해달라고 요청을 하였고, 원의 면적도 고려해서 계산할 수 있는 로직을 구현해달라고 추가 요청을 함. 그러나 현재 `AreaCalculator`  클래스는 사각형만을 고려해서 구현되어있으며 원에 대해서는 적용이 불가능한 상태임. 따라서 클래스를 전면적으로 수정해야함. 이는 Open-Closed Principle을 준수하지 않는 상태임!!

```php
<?php namespace Acme;

class Circle {
    public $radius;

    function __construct($radius)
    {
        $this->radius = $radius;
    }
}
```



먼저, 변수명을 `$squares` 을  `$shapes` 으로 변경시킬 수 있음. 그런데 도형에 따라 면적을 계산하는 계산식이 다른 상황임. 이때 우리가  우선적으로 생각할 수 있는 것은 분기문임. 

```php
<?php namespace Acme;

class AreaCalculator {

    public function calculate($shapes)
    {
        foreach ($shapes as $shape)
        {
            if (is_a($shape, 'square')) // if ($shape instanceof Square)
            {
                $area[] = $shapes->width * $shapes->height;
            }
            else
            {
                $area[] = $shapes->radius * $shapes->radius * pi();
            }
        }

        return array_sum($area);
    }
}
```



또 다시, 삼각형 클래스를 추가하여 면적 계산 클래스에 반영해야하는 경우라면 또다시 분기문을 통해 코드를 수정해야 하는 것일까? 이처럼 변화가 생길 때마다 코드를 매번 수정하는것이 맞는 것일까? This is sort of things that lead to code rot.

*how can we extend this behavior while keeping the class closed from modification?* 

#### Seperate extensible behavior behind an interface, and flip the dependencies

`ShapeInterface` 인터페이스 생성후 인터페이스를 각각의 클래스에 implement 시킴.

```php
<?php namespace Acme;

interface Shape {
    public function area();
}
```

