<?php



use Acme\User\Person;
use Acme\Staff;
use Acme\Business;

$harry = new Person('Harry Lee');
$staff = new Staff([$harry]);
$laracasts = new Business($staff);
$laracasts->hire(new Person('Ron Wizlie'));

var_dump($laracasts->getStaffMembers());

