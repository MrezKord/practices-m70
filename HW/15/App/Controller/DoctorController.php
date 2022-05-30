<?php

namespace App\Controller;

use Core\Application;
use Core\dbModel;
use Core\File\FileHandel;
use Core\Model;
use Core\Request;
use Core\Response;
use Core\View;
use Model\Department;
use Model\DoctorProfile;
use Model\UserRegister;
use Model\Visit;
use Model\WorkingTime;

class DoctorController
{

    private View $view;
    private UserRegister $user;
    private DoctorProfile $doctor;
    private WorkingTime $time;
    private Department $department;
    private Visit $visit;

    public function __construct()
    {
        $this->view = Application::$app->getInstanceOfClasses('View');
        $this->user = new UserRegister;
        $this->doctor = new DoctorProfile;
        $this->time = new WorkingTime;
        $this->department = new Department;
        $this->visit = new Visit;
        $this->view->setLayout('Doctor');
    }

    public function DoctorHome()
    {
        $find12 = $this->user->join(
            ['[><]Doctors' => ['id' => 'user_id']],
            '*',
            ['email' => $_SESSION['email']]
        );
        if ($find12) {
            $find23 = $this->doctor->join(
                ['[><]working_time' => ['Doctors.id' => 'doctor_id']],
                '*',
                ['doctor_id' => $find12[0]['id']]
            );
    
            return $this->view->show(['Doctor', "Doctor.php"], ['controlltime' => $find23, 'controllBasicProfile' => $find12]);    
        }
        return $this->view->show(['Doctor', "Doctor.php"], ['controllBasicProfile' => $find12]);
    }

    public function Doctor()
    {
        $user = $this->doctor->find(['user_id' => $_SESSION['id']]);
        if ($user) {
            $data = $this->visit->get('*', ['doctor_id' => $user['id']]);
            $result = array_map(fn($val) => $this->user->join(['[><]Patient' => ['id' => 'user_id']], ['firstName', 'lastName'], ['Patient.id' => $val['patient_id']]), $data);
    
            foreach ($data as $key => &$value) {
                $value['patient_name'] = $result[$key][0]['firstName'].' '.$result[$key][0]['lastName'];
                $value['day'] = $this->time->label()[$value['day']];
            }
            return $this->view->show(['Doctor', "Doctor_Visit.php"], $data);
        }
        return $this->view->show(['Doctor', "Doctor_Visit.php"]);
    }

    public function editProfile()
    {
        $departmentsName = array_map(fn($val) => $val['name'], $this->department->get('*'));
        $data = $this->user->find(['email' => $_SESSION['email']]);
        $find = $this->doctor->find(['user_id' => $_SESSION['id']]);
        if (!$data['status']) {
            return $this->view->show(['Doctor', "Doctor_edit_profile_before.php"], ['data' => $data, 'model' => $this->doctor]);
        }

        if ($data['status'] && !$find) {
            return $this->view->show(['Doctor', "Doctor_create_profile.php"], [
            'model' => $this->doctor,
            'find' => $find,
            'departmentsName' => $departmentsName 
        ]);
        }
        return $this->view->show(['Doctor', "Doctor_edit_profile.php"], [
            'model' => $this->doctor,
            'find' => $find,
            'departmentsName' => $departmentsName 
        ]);
    }

    public function createProfilePost(Request $request, Response $response)
    {
        $this->doctor->loadData($request->getBody());
        if ($this->doctor->validate()) {
            $this->doctor->user_id = $_SESSION['id'];
            $this->doctor->profile_photo = FileHandel::move($request->getFile(), 'profile_photo', ['Data', $_SESSION['id']]);
            $this->doctor->save();
            return $response->redirect('/Doctor-Profile');
        }
        return $this->view->show(['Doctor', "Doctor_create_profile.php"], ['model' => $this->doctor]);
    }

    public function editProfilePut(Request $request, Response $response)
    {
        $this->doctor->loadData($request->getBody());
        $find = $this->doctor->find(['user_id' => $_SESSION['id']]);
        if ($this->doctor->validate()) {
            FileHandel::remove($find['profile_photo']);
            $this->doctor->profile_photo = FileHandel::move($request->getFile(), 'profile_photo', ['Data', $_SESSION['id']]);
            $this->doctor->update($this->doctor->properties(), ['user_id' => $_SESSION['id']]);
            return $response->redirect('/Doctor-Profile');
        }
        return $this->view->show(['Doctor', "Doctor_edit_profile.php"], ['model' => $this->doctor]);
    }

    public function workingTime()
    {
        $join = $this->doctor->join(['[><]working_time' => ['id' => 'doctor_id']], '*', ['user_id' => $_SESSION['id']]);
        $find = $this->doctor->find(['user_id' => $_SESSION['id']]);
        if ($join) {
            return $this->view->show(['Doctor', "Doctor_working_time_update.php"], ['model' => $this->time, 'find' => $find]);
        }
        return $this->view->show(['Doctor', "Doctor_working_time.php"], ['model' => $this->time, 'find' => $find]);
    }

    public function workingTimeSave(Request $request, Response $response)
    {
        $findDoctor = $this->doctor->find(['user_id' => $_SESSION['id']]);
        $this->time->loadData($request->getBody());
        $data = $this->user->join(['[>]Doctors' => ['id' => 'user_id']], '*', ['email' => $_SESSION['email']]);
        $find = $this->department->find(['name' => $data[0]['department']]);
        $this->time->setDay($find['user_active_day']);
        if ($this->time->validate()) {
            foreach ($this->time->attributes() as $key => $value) {
                if (!$this->time->{$value}) {
                    $this->time->{$value} = '-';
                }
            }
            $this->time->doctor_id = $data[0]['id'];            
            $this->time->save();
            return $response->redirect('/Doctor-working-time');
        }
        return $this->view->show(['Doctor', "Doctor_working_time.php"], ['model' => $this->time, 'find' => $findDoctor]);
    }

    public function workingTimeUpdate(Request $request, Response $response)
    {
        $this->time->loadData($request->getBody());
        $data = $this->user->join(['[>]Doctors' => ['id' => 'user_id']], '*', ['email' => $_SESSION['email']]);
        $find = $this->department->find(['name' => $data[0]['department']]);
        $this->time->setDay($find['user_active_day']);
        if ($this->time->validate()) {
            foreach ($this->time->attributes() as $key => $value) {
                if (!$this->time->{$value}) {
                    $this->time->{$value} = '-';
                }
            }
            $this->time->doctor_id = $data[0]['id'];
            $this->time->update($this->time->properties(), ['doctor_id' => $this->time->doctor_id]);
            return $response->redirect('/Doctor-working-time');
        }
        return $this->view->show(['Doctor', "Doctor_working_time_update.php"], ['model' => $this->time]);
    }
}