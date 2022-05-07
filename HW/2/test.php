<?php

$array1 = [6, 7, 8, 9, 10, 11, 12];
$array2 = ['a', 'v', 'd', 'ds', 'dsadsa', 'dasd', 'asdddddddd'];


// $filter = array_filter($array1, fn($val) => $val%2 === 0);
$result = array_map(fn ($val, $v) => $val.$v, $array1, $array2);

print_r($result);

// $result = array_replace($array1, $result);

// print_r($result);

// $fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");
