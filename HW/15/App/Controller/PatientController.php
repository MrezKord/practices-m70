<?php

namespace App\Controller;

use Core\Application;
use Core\File\FileHandel;
use Core\Request;
use Core\Response;
use Model\DoctorProfile;
use Model\Patient;
use Model\UserRegister;
use Model\Visit;
use Model\WorkingTime;

class PatientController
{

    private $user;
    private $patient;
    private $visit;
    private $doctor;
    private $time;

    public function __construct()
    {
        $this->view = Application::$app->getInstanceOfClasses('View');
        $this->user = new UserRegister;
        $this->patient = new Patient;
        $this->visit = new Visit;
        $this->doctor = new DoctorProfile;
        $this->view->setLayout('Patient');           
        $this->time = new WorkingTime;
    }

    public function PatientProfile () 
    {
        $find = $this->user->join(['[><]Patient' => ['id' => 'user_id']], '*', ['users.id' => $_SESSION['id']]);
        return $this->view->show(["Patient", "Patient.php"], ['find' => $find]);
    }

    public function appointment()
    {
        $user = $this->patient->find(['user_id' => $_SESSION['id']]);
        if ($user) {
            $data = $this->visit->get('*', ['patient_id' => $user['id']]);
            $result = array_map(fn($val) => $this->user->join(['[><]Doctors' => ['id' => 'user_id']], ['firstName', 'lastName'], ['Doctors.id' => $val['doctor_id']]), $data);
            foreach ($data as $key => &$value) {
                $value['doctor_name'] = $result[$key][0]['firstName'].' '.$result[$key][0]['lastName'];
                $value['day'] = $this->time->label()[$value['day']];
            }
            return $this->view->show(["Patient", "appointment.php"], ['visit' => $data]);
        }
        return $this->view->show(["Patient", "appointment.php"]);
    }

    public function appointmentCancel(Request $request, Response $response)
    {
        $this->visit->delete(['id' => $request->getBody()['appointment']]);
        return $response->redirect('/Patient-appointment');
    }

    public function PatientEditProfile()
    {
        $find = $this->user->join(['[><]Patient' => ['id' => 'user_id']], '*', ['users.id' => $_SESSION['id']]);
        if (!$find) {
            return $this->view->show(["Patient", "PatientEditProfilePost.php"], ['model' => $this->patient]);
        }
        return $this->view->show(["Patient", "PatientEditProfileUpdate.php"], ['model' => $this->patient]);
    }

    public function PatientEditProfilePost(Request $request, Response $response)
    {
        $this->patient->loadData($request->getBody());
        if ($this->patient->validate()) {
            $this->patient->profile_photo = FileHandel::move($request->getFile(), 'profile_photo', ['Data', $_SESSION['id']]);
            $this->patient->save();
            return $response->redirect('/Patient-Profile');
        }
        return $this->view->show(['Patient', "PatientEditProfilePost.php"], ['model' => $this->patient]);
    }

    public function PatientEditProfileUpdate(Request $request, Response $response)
    {
        $this->patient->loadData($request->getBody());
        $find = $this->patient->find(['user_id' => $_SESSION['id']]);
        if ($this->patient->validate()) {
            FileHandel::remove($find['profile_photo']);
            $this->patient->profile_photo = FileHandel::move($request->getFile(), 'profile_photo', ['Data', $_SESSION['id']]);
            $this->patient->update($this->patient->properties(), ['user_id' => $_SESSION['id']]);
            return $response->redirect('/Patient-Profile');
        }
        return $this->view->show(['Patient', "PatientEditProfileUpdate.php"], ['model' => $this->patient]);
    }

}