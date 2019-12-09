<?php

class Person {

    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

class Business {

    protected $staff;

    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function hire(Person $person)
    {
        $this->staff->add($person);
    }

    public function getStaffMembers()
    {
        return $this->staff->members();
    }
}

class Staff {

    protected $members = [];

    public function __construct($members = [])
    {
        $this->members = $members;
    }

    public function add(Person $person)
    {
        $this->members[] = $person;
    }

    public function Members()
    {
        return $this->members;
    }
}

$harry = new Person('harry lee');
$staff = new Staff([$harry]);
$laracasts = new Business($staff);

$laracasts->hire(new Person('Ron Wizlie'));

//$laracasts->hire($harry);

var_dump($staff);
var_dump($laracasts->getStaffMembers());
