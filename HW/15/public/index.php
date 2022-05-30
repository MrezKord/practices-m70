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
$app->get('/doctor-appointment', [Controller::class, 'doctorAppointment']);
$app->post('/doctor-appointment', [Controller::class, 'doctorAppointmentPost']);


// Authentication
$app->get('/Login', [AuthController::class, 'loginGet']);
$app->post('/Login', [AuthController::class, 'loginPost']);
$app->get('/Register', [AuthController::class, 'register']);
$app->post('/Register', [AuthController::class, 'register']);
$app->get('/Logout', [AuthController::class, 'Logout']);


// Doctor controller
$app->get('/Doctor-Profile', [DoctorController::class, 'DoctorHome']);
$app->get('/Patient-visit', [DoctorController::class, 'Doctor']);
$app->post('/Patient-visit', [DoctorController::class, 'DoctorPost']);
// Doctor Profile
$app->get('/Doctor-edit-profile', [DoctorController::class, 'editProfile']);
$app->post('/Doctor-edit-profile', [DoctorController::class, 'createProfilePost']);
$app->put('/Doctor-edit-profile', [DoctorController::class, 'editProfilePut']);
//Working Time
$app->get('/Doctor-working-time', [DoctorController::class, 'workingTime']);
$app->post('/Doctor-working-time', [DoctorController::class, 'workingTimeSave']);
$app->put('/Doctor-working-time', [DoctorController::class, 'workingTimeUpdate']);

// Bos controller
$app->get('/Boss-Profile', [BossController::class, 'BossHome']);
$app->get('/Boss-confirm', [BossController::class, 'Boss']);
$app->post('/Boss-confirm', [BossController::class, 'BossPost']);
$app->get('/Boss-edit-profile', [BossController::class, 'editProfile']);
$app->post('/Boss-edit-profile', [BossController::class, 'editProfilePost']);
$app->put('/Boss-edit-profile', [BossController::class, 'editProfileUpdate']);
$app->get('/Boss-create-department', [BossController::class, 'BossCreateDepartment']);
$app->get('/Boss-show-department', [BossController::class, 'showDepartment']);
$app->post('/Boss-create-department', [BossController::class, 'BossCreateDepartmentPost']);
$app->put('/Boss-create-department', [BossController::class, 'BossUpdateDepartment']);
$app->delete('/Boss-create-department', [BossController::class, 'BossDeleteDepartment']);
$app->get('/Boss-show-doctors', [BossController::class, 'showDoctors']);

// Patient controller
$app->get('/Patient-Profile', [PatientController::class, 'PatientProfile']);
$app->get('/Patient-appointment', [PatientController::class, 'appointment']);
$app->get('/Patient-edit-profile', [PatientController::class, 'PatientEditProfile']);
$app->post('/Patient-edit-profile', [PatientController::class, 'PatientEditProfilePost']);
$app->put('/Patient-edit-profile', [PatientController::class, 'PatientEditProfileUpdate']);
$app->delete('/Patient-appointment', [PatientController::class, 'appointmentCancel']);

$app->run();

