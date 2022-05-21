<?php

namespace App\Controller;

use Core\Application;
use Core\Request;
use Model\UserRegister;

class BossController
{

    public function __construct()
    {
        $this->view = Application::$app->getInstanceOfClasses('View');
        $this->user = new UserRegister;           
        $this->view->setLayout('Boss');           
    }

    public function BossHome()
    {
        echo $this->view->show(['Boss', "Boss_Home.php"], ['model' => $this->user]);
    }
    
    public function Boss () 
    {
        echo $this->view->show(['Boss', "Boss.php"], ['model' => $this->user]);
    }

    public function BossPost(Request $request)
    {
        $this->user->loadData($request->getBody());
        $this->user->update(['status' => $this->user::ACTIVE], ['email' => $this->user->email]);
        echo $this->view->show(['Boss',"Boss.php"], ['model' => $this->user]);
    }

    public function BossCreateDepartment()
    {
        echo $this->view->show(['Boss' ,"Boss_Create_Department.php"], ['model' => $this->user]);
    }

    public function editProfile()
    {
        echo $this->view->show(['Boss', "Boss_edit_profile.php"], ['model' => $this->user]);
    }

    public function editProfilePost()
    {
        //TODO
    }
}