<?php

require_once "../vendor/autoload.php";

use App\Controller\AuthController;
use App\Controller\Controller;
use App\Controller\RoleController;
use App\Controller\BossController;
use App\Controller\DoctorController;
use App\Controller\PatientController;
use Core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
    ,
    'medoo' => [
        'type' => $_ENV['TYPE'],
        'host' => $_ENV['HOST'],
        'database' => $_ENV['DB_NAME'],
        'username' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];



$app = new Application($config);

// Apply Migration
$app->getInstanceOfClasses('connection')->applyMigration();

// Home
$app->get('/', [Controller::class, 'start']);
$app->get('/home', [Controller::class, 'home']);

// Public
$app->get('/doctorList', [Controller::class, 'doctorList']);
$app->post('/doctorList', [Controller::class, 'doctorListPost']);
$app->post('/profile-doctor-fake', [Controller::class, 'ProfileDoctorFake']);

// Authentication
$app->get('/Login', [AuthController::class, 'loginGet']);
$app->post('/Login', [AuthController::class, 'loginPost']);
$app->get('/Register', [AuthController::class, 'register']);
$app->post('/Register', [AuthController::class, 'register']);


// Doctor controller
$app->get('/Doctor-Profile', [DoctorController::class, 'DoctorHome']);
$app->get('/Patient-visit', [DoctorController::class, 'Doctor']);
$app->post('/Patient-visit', [DoctorController::class, 'DoctorPost']);
$app->get('/Doctor-edit-profile', [DoctorController::class, 'editProfile']);
$app->post('/Doctor-edit-profile', [DoctorController::class, 'editProfilePost']);


// Bos controller
$app->get('/Boss-Profile', [BossController::class, 'BossHome']);
$app->get('/Boss-confirm', [BossController::class, 'Boss']);
$app->post('/Boss-confirm', [BossController::class, 'BossPost']);
$app->get('/Boss-create-department', [BossController::class, 'BossCreateDepartment']);
$app->get('/Boss-edit-profile', [BossController::class, 'editProfile']);

// Patient controller
$app->get('/Patient-Profile', [PatientController::class, 'PatientProfile']);

$app->run();

