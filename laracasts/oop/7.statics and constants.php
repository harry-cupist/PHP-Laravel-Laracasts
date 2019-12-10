 <?php

//class Math {
//    public function add()
//    {
//        return array_sum(func_get_args());
//    }
//}
// $math = new Math;
// var_dump($math->add(1, 2, 3, 4));

//class Math {
//    public static function add(...$nums)
//    {
//        return array_sum($nums);
//    }
//}

//echo Math::add(1,2,3);


//class Person {
//    public static $age = 1;
//
//    public function haveBirthday()
//    {
//        static::$age += 1;
//    }
//
//}
//
//$harry = new Person;
//$harry->haveBirthday(); // 2
//$harry->haveBirthday(); // 3
//
////$harry->age; // Accessing static property Person::$age as non static
//
//echo $harry::$age;
//
//
//$ron = new Person;
//$ron->haveBirthday(); // expected 2 but returns 4
//
//echo $ron::$age;


class BankAccount {
    const TAX = .09;

}

echo BankAccount::TAX;