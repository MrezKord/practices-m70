<?php

require_once "../vendor/autoload.php";

use App\Controller\AuthController;
use App\Controller\Controller;
use Core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];



$app = new Application($config['db']);

$app->get('/', [Controller::class, 'start']);
$app->get('/home', [Controller::class, 'home']);
$app->get('/Contact', [Controller::class, 'Contact']);
$app->post('/Contact', [Controller::class, 'dataContact']);
$app->get('/Login', [AuthController::class, 'login']);
$app->get('/Register', [AuthController::class, 'register']);
$app->post('/Register', [AuthController::class, 'register']);

$app->run();

