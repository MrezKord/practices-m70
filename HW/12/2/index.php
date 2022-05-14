<?php

include "./vendor/autoload.php";

use Authenticate\Auth;
use DataControl\Database\Connection;
use DataControl\Database\DB;
use DataControl\JsonReader;
use User\NormallUser;

$table = 'CREATE TABLE IF NOT EXISTS `Users` (
    `Username` VARCHAR(255) NOT NULL,
    `Email` VARCHAR(255) NOT NULL,
    `Password` INT NOT NULL
);';



$db = new DB();
$db->create($table);
$db->path('Users');

$a = new JsonReader();
$a->create('user.json');
$a->path('user.json');

$user = new NormallUser('Mohammadreza', 'mohammadrezasaeedi@gmail.com', 1111);
$user1 = new NormallUser('Mohammad', 'rezasaeedi@gmail.com', 1111);

$auth = new Auth($a);

// $auth->register($user1);

// $auth->login('Mohammad', 1111);


// print_r($a->exportToArray());

// $a->delete('Username', 'Mohammad');

// print_r($a->exportToArray());

