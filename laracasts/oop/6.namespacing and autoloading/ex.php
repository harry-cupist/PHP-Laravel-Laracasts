<?php

use Acme\Users\Person;
use Acme\Staff;
use Acme\Business;

$harry = new Person('harry lee');
$staff = new Staff([$harry]);
$laracasts = new Business($staff);
$laracasts->hire(new Person('Ron Wizlie'));


var_dump($laracasts->getStaffMembers());
