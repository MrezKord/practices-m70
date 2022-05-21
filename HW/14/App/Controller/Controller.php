<?php

namespace App\Controller;

use Core\Request;
use Core\View;
use Core\Application;
use Core\dbModel;
use Model\UserRegister;
use PDO;

class Controller
{

    private $view;
    private dbModel $doctor;

    public function __construct()
    {
        $this->view = Application::$app->getInstanceOfClasses('View');
        $this->view->setLayout('Main');
        $this->doctor = new UserRegister;
    }

    public function home()
    {
        $name = $this->doctor->find(['email' => $_SESSION['email']]);
        $this->view->show("Home.php", ['name' => $name]);
    }

    public function Contact()
    {
        $this->view->show("Contact.php", ['name' => 'reza']);
    }

    public function start()
    {
        Application::$app->getInstanceOfClasses('session')->unSet('email');
        Application::$app->getInstanceOfClasses('session')->unSet('id');
        echo $this->view->showOnly("Start.php");
    }

    public function dataContact(Request $request)
    {
        print_r($request->getBody());
    }

    public function doctorList()
    {
        $result = $this->doctor->join(['[><]Doctors' => ['id' => 'user_id']], '*');
        $this->view->setLayout('DoctorList');
        $this->view->show("DoctorList.php", $result);
    }

    public function doctorListPost(Request $request)
    {
        if (array_key_exists('name', $request->getBody())) {
            $value = $request->getBody()['name'];
            $result = $this->doctor->join(['[><]Doctors' => ['id' => 'user_id']], '*', ['firstName[~]' => $value]);
        } else {
            $value = $request->getBody()['Specialty'];
            $result = $this->doctor->join(['[><]Doctors' => ['id' => 'user_id']], '*', ['Doctors.department' => $value]);
        }

        $result_layout = $this->doctor->join(['[><]Doctors' => ['id' => 'user_id']], '*');
        $this->view->setLayout('DoctorList');
        return $this->view->show("DoctorList.php", $result, $result_layout);
    }


    public function ProfileDoctorFake(Request $request)
    {
        $result = $this->doctor->join(['[><]Doctors' => ['id' => 'user_id']], '*',['Doctors.id' => $request->getBody()['profile']]);
        $this->view->setLayout('Auth');
        $this->view->show("Doctor_Profile_Fake.php", $result);
    }
}
