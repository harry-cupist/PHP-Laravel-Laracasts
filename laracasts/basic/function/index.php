<?php

require 'function.php';
require 'index.view.php';

$animals = ['dog', 'cat'];

dd($animals);
// dd(['dog', 'cat']);

function checkAge($age){
   return ($age < 21) ? false : true;
}

if (checkAge(15)) {
    echo 'Welcome to the club';
} else {
    echo ' sorry! you are not allowed to come in!';
}



