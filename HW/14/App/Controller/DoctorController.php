<?php

namespace App\Controller;

use Core\Application;
use Core\dbModel;
use Core\File\FileHandel;
use Core\Model;
use Core\Request;
use Core\View;
use Model\DoctorProfile;
use Model\UserRegister;

class DoctorController
{

    private View $view;
    private dbModel $user;
    private dbModel $doctor;

    public function __construct()
    {
        $this->view = Application::$app->getInstanceOfClasses('View');
        $this->user = new UserRegister;    
        $this->doctor = new DoctorProfile;       
        $this->view->setLayout('Doctor');           
    }

    public function DoctorHome() 
    {
        $data = $this->user->join(['[><]Doctors' => ['id' => 'user_id']], '*', ['email' => $_SESSION['email']]);
        echo $this->view->show(['Doctor' ,"Doctor.php"], $data);
    }

    public function Doctor()
    {
        $data = $this->user->join(['[><]Doctors' => ['id' => 'user_id']], '*', ['email' => $_SESSION['email']]);
        echo $this->view->show(['Doctor' ,"Doctor_Visit.php"], $data);
    }

    public function editProfile()
    {
        $data = $this->user->find(['email' => $_SESSION['email']]);
        if (!$data['status']) {
            return $this->view->show(['Doctor' ,"Doctor_edit_profile_before.php"], ['data' => $data, 'model' => $this->doctor]);
        }
        return $this->view->show(['Doctor' ,"Doctor_edit_profile.php"], ['model' => $this->doctor]);
    }
    
    public function editProfilePost(Request $request)
    {
        $this->doctor->loadData($request->getBody());
        if ($this->doctor->validate()) {
            $this->doctor->profile_photo = FileHandel::move($request->getFile(), 'profile_photo', ['Data', $_SESSION['id']]);
            $this->doctor->user_id = $_SESSION['id'];
            $this->doctor->save();
            $this->doctor->setAllAttribute('');
        }
        echo $this->view->show(['Doctor' ,"Doctor_edit_profile.php"], ['model' => $this->doctor]);
    }
    
}