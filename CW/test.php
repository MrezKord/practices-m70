<?php

$host = "localhost";
$username = "root";
$password = "";

$dns = 'mysql:host=' . $host . ';dbname=' . 'reza';

// // Create connection
// $conn = new mysqli($servername, $username, $password, 'reza');

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

// var_dump($conn);

//------------------------------------

$pdo = new PDO($dns, $username, $password);

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$a = '*';
$stmt = $pdo->prepare('SELECT '.$a.' FROM test');

$stmt->execute();

$name = $stmt->fetchAll();

print_r($name);

// $str = "Is your name O\'reilly?";

// // Outputs: Is your name O'reilly?
// echo stripslashes($str);
