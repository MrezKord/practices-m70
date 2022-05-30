<?php

namespace App\Controller;

use Core\Request;
use Core\View;
use Core\Application;
use Core\dbModel;
use Core\Response;
use Model\Patient;
use Model\UserRegister;
use Model\Visit;
use Model\WorkingTime;
use PDO;

class Controller
{

    private $view;
    private dbModel $user;
    private dbModel $time;
    private dbModel $patient;
    private dbModel $visit;

    public function __construct()
    {
        $this->view = Application::$app->getInstanceOfClasses('View');
        $this->view->setLayout('Main');
        $this->user = new UserRegister;
        $this->time = new WorkingTime;
        $this->patient = new Patient;
        $this->visit = new Visit;
    }

    public function home()
    {
        $name = $this->user->find(['email' => $_SESSION['email']]);
        $this->view->show("Home.php", ['name' => $name]);
    }


    public function start()
    {
        echo $this->view->showOnly("Start.php");
    }

    public function doctorList()
    {
        $id = (isset($_SESSION['id'])) ? $_SESSION['id'] : '';
        $patient = $this->user->join([
            '[><]Patient' => ['id' => 'user_id']
        ], '*', ['user_id' => $id]);
        $result = $this->user->join(['[><]Doctors' => ['id' => 'user_id']], '*');
        $this->view->setLayout('DoctorList');
        $this->view->show("DoctorList.php", ['doctors' => $result, 'patient' => $patient], $result);
    }

    public function doctorListPost(Request $request, Response $response)
    {
        $id = (isset($_SESSION['id'])) ? $_SESSION['id'] : '';
        if (array_key_exists('name', $request->getBody())) {
            $value = $request->getBody()['name'];
            $result = $this->user->join(['[><]Doctors' => ['id' => 'user_id']], '*', ['firstName[~]' => $value]);
        } else {
            $value = $request->getBody()['Specialty'];
            $result = $this->user->join(['[><]Doctors' => ['id' => 'user_id']], '*', ['Doctors.specialty' => $value]);
        }

        $patient = $this->user->join([
            '[><]Patient' => ['id' => 'user_id']
        ], '*', ['user_id' => $id]);
        $result_layout = $this->user->join(['[><]Doctors' => ['id' => 'user_id']], '*');
        $this->view->setLayout('DoctorList');
        return $this->view->show("DoctorList.php", ['doctors' => $result, 'patient' => $patient], $result_layout);
    }


    public function ProfileDoctorFake(Request $request)
    {
        $result = $this->user->join([
            '[><]Doctors' => ['id' => 'user_id']
        ], '*', [
            'Doctors.id' => $request->getBody()['profile']
        ]);
        $working_time = $this->time->find(['doctor_id' => $result[0]['id']]);
        $this->view->setLayout('Auth');
        $this->view->show("Doctor_Profile_Fake.php", [
            'data' => $result,
            'working_time' => $working_time,
            'label' => $this->time->label(),
        ]);
    }
    
    public function doctorAppointment(Request $request)
    {
        $patient = $this->patient->find(['user_id' => $_SESSION['id']]);
        $doctor_visit = $this->visit->get('*', ['doctor_id' => $request->getBody()['doctor_id']]);

        // Booked times
        $visited = array_map(fn($val) => $val['time'], $doctor_visit);
        
        // All times
        $result = array_map(fn ($val) => intval($val), explode('-', $request->getBody()['hours']));
        $result[0] = ($result[0] == 24) ? 0 : $result[0];
        $result = range($result[0], $result[1]);
        $result = array_map(fn ($val) => ($val !== $result[array_key_last($result)]) ? "$val" . "-" . $result[array_search($val, $result) + 1] : '', $result);
        array_pop($result);

        // Available times
        $result = array_diff($result, $visited);

        $this->view->setLayout('Auth');
        if (!$result) {
            return $this->view->show('Doctor_visit_time_full.php');
        }

        return $this->view->show("Doctor_visit_time.php", [
            'hours' => $result,
            'request' => $request->getBody(),
            'error' => $this->visit->getFirstError('time'),
            'patient_id' => $patient['id']
        ]);
    }

    public function doctorAppointmentPost(Request $request, Response $response)
    {
        $patient = $this->patient->find(['user_id' => $_SESSION['id']]);
        $this->visit->loadData($request->getBody());
        if ($this->visit->validate()) {
            $this->visit->save();
            return $response->redirect('/doctorList');
        }
        $container = $request->getBody();
        $container['day-key'] = $request->getBody()['day'];
        $container['day'] = $this->time->label()[$container['day-key']];
        $this->view->setLayout('Auth');
        return $this->view->show("Doctor_visit_time.php", [
            'hours' => json_decode(base64_decode($container['hours']), true),
            'request' => $container,
            'error' => $this->visit->getFirstError('time'),
            'patient_id' => $patient['id']
        ]);
    }
}
