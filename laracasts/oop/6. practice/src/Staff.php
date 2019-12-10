<?php

namespace Acme;
use Acme\User\Person;

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
