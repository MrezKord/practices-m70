<?php

namespace App\Controller;

use Core\Application;
use Core\Request;
use Model\UserRegister;

class PatientController
{

    private $user;

    public function __construct()
    {
        $this->view = Application::$app->getInstanceOfClasses('View');
        $this->user = new UserRegister;           
    }

    public function PatientProfile () 
    {
        echo $this->view->showOnly(["Patient", "Patient.php"]);
    }

}