<?php

$person = [
    'age' => 31,
    'hair' => 'brown',
    'career' => 'web developer'
];

$animals = ['dog', 'cat'];

$person['name'] = 'harry'; # 연관배열에 데이터 추가
$animals[] = 'elephant'; # 일반배열에 데이터 추가

//echo $person; // echo는 string을 반환해야함. 배열에는 부적합

var_dump($person); // 배열 출력시 사용 literally dump the values
die(var_dump($person)); // php 코드를 die 시킴.
var_dump($animals);

//require 'index.view.php';