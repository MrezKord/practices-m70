<?php

namespace App\Controller;

use Core\Application;
use Core\File\FileHandel;
use Core\Request;
use Core\Response;
use Core\View;
use Model\BossProfile;
use Model\Department;
use Model\DoctorProfile;
use Model\UserRegister;

class BossController
{

    private $Boss;
    private $user;
    private $department;
    private $doctor;

    public function __construct()
    {
        $this->view = Application::$app->getInstanceOfClasses('View');
        $this->user = new UserRegister;
        $this->Boss = new BossProfile;
        $this->department = new Department;
        $this->doctor = new DoctorProfile;
        $this->view->setLayout('Boss');
    }

    public function BossHome()
    {
        $find = $this->user->find(['id' => $_SESSION['id']]);
        $join = $this->user->join(['[><]Bosses' => ['id' => 'user_id']], '*', ['Users.id' => $_SESSION['id']]);
        return $this->view->show(['Boss', "Boss_Home.php"], [
            'find' => $find,
            'join' => $join
        ]);
    }

    public function Boss()
    {
        $findDepartment = $this->department->get('*');
        $findUser = $this->user->find(['email' => $_SESSION['email']]);

        $request = $this->user->get(['firstName', 'lastName', 'role', 'email'], ['AND' => ['role[!]' => 'Patient', 'status' => 0]]);
        return $this->view->show(['Boss', "Boss.php"], [
            'findDepartment' => $findDepartment,
            'findUser' => $findUser,
            'request' => $request
        ]);
    }

    public function BossPost(Request $request, Response $response)
    {
        $this->user->loadData($request->getBody());
        $this->user->update(['status' => $this->user::ACTIVE], ['email' => $this->user->email]);
        $response->redirect('/Boss-confirm');
    }

    
    public function editProfile()
    {
        $find = $this->user->join(['[>]Bosses' => ['id' => 'user_id']], '*', ['user_id' => $_SESSION['id']]);
        if ($find) {
            return $this->view->show(['Boss', "Boss_update_profile.php"], ['model' => $this->Boss]);
        }
        return $this->view->show(['Boss', "Boss_edit_profile.php"], ['model' => $this->Boss]);
    }
    
    public function editProfilePost(Request $request, Response $response)
    {
        $this->Boss->loadData($request->getBody());
        if ($this->Boss->validate()) {
            $this->Boss->user_id = $_SESSION['id'];
            $this->Boss->profile_photo = FileHandel::move($request->getFile(), 'profile_photo', ['Data', $_SESSION['id']]);
            $this->Boss->save();
            return $response->redirect('/Boss-Profile');
        }
        return $this->view->show(['Doctor', "Boss_edit_profile.php"], ['model' => $this->doctor]);
    }
    
    public function editProfileUpdate(Request $request, Response $response)
    {
        $this->Boss->loadData($request->getBody());
        $find = $this->Boss->find(['user_id' => $_SESSION['id']]);
        if ($this->Boss->validate()) {
            FileHandel::remove($find['profile_photo']);
            $this->Boss->profile_photo = FileHandel::move($request->getFile(), 'profile_photo', ['Data', $_SESSION['id']]);
            $this->Boss->update($this->Boss->properties(), ['user_id' => $_SESSION['id']]);
            return $response->redirect('/Boss-Profile');
        }
        return $this->view->show(['Doctor', "Boss_update_profile.php"], ['model' => $this->doctor]);
    }
    
    public function BossCreateDepartment(Request $request)
    {
        $join = $this->user->join(['[><]Bosses' => ['id' => 'user_id']], '*', ['user_id' => $_SESSION['id']]);
        if (!$request->getBody()) {
            $find = $this->user->find(['id' => $_SESSION['id']]);
            return $this->view->show(['Boss', "Boss_Create_Department.php"], [
                'model' => $this->department,
                'find' => $find,
                'join' => $join
            ]);
        }
        return $this->view->show(['Boss', "Boss_Edit_Department.php"], [
            'model' => $this->department,
            'creator_id' => $join[0]['id'],
            'department_id' => $request->getBody()['department_id']
        ]);
    }

    public function BossCreateDepartmentPost(Request $request, Response $response)
    {
        $find = $this->user->find(['id' => $_SESSION['id']]);
        $this->department->loadData($request->getBody());
        if ($this->department->validate()) {
            $this->department->save();
            return $response->redirect('/Boss-show-department');
        }
        return $this->view->show(['Boss', "Boss_Create_Department.php"], ['model' => $this->department, 'find' => $find]);
    }

    public function showDepartment()
    {
        $department = $this->department->get('*');
        return $this->view->show(['Boss', "Boss_show_department.php"], ['department' => $department]);
    }

    public function BossUpdateDepartment(Request $request, Response $response)
    {
        $this->department->loadData($request->getBody());
        if ($this->department->validate()) {
            $this->department->update($this->department->properties(), ['id' => $request->getBody()['department_id']]);
            return $response->redirect('/Boss-show-department');
        }
        return $this->view->show(['Boss', "Boss_Edit_Department.php"], [
            'model' => $this->department,
            'creator_id' => $this->department->creator_id,
            'department_id' => $request->getBody()['department_id']
        ]);    
    }

    public function BossDeleteDepartment(Request $request, Response $response)
    {
        $this->department->delete(['id' => $request->getBody()['department_id']]);
        return $response->redirect('/Boss-show-department');
    }

    public function showDoctors()
    {
        $result = $this->user->join(['[><]Doctors' => ['id' => 'user_id']], '*');
        return $this->view->show(['Boss', "Boss_show_doctors.php"], [
            'data' => $result,
        ]);    
    }

}
