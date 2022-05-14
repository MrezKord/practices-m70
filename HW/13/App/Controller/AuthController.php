<?php

namespace App\Controller;

use Core\Application;
use Core\Request;
use Core\View;
use Model\RegisterModel;

class AuthController
{
    private $view;

    public function __construct()
    {
        $this->view = Application::$app->getInstanceOfClasses('View');
        $this->view->setLayout('Auth');
    }


    public function login()
    {
        $this->view->show('Login.php', ['status' => 'you are login']);
    }

    public function register(Request $request)
    {
        $registerModel = new RegisterModel;
        $registerModel->loadData($request->getBody());
        if ($request->isPost()) {

            if ($registerModel->validate() && $registerModel->register()) {
                Application::$app->getInstanceOfClasses('response')->redirect('/home');
            }

            return $this->view->show('Register.php', [
                'model' => $registerModel
            ]);
        }

        return $this->view->show('Register.php', [
            'model' => $registerModel
        ]);
    }
}