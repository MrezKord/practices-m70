<?php

namespace App\Controller;

use Core\Application;
use Core\Request;
use Core\View;
use Model\UserLogin;
use Model\UserRegister;

class AuthController
{
    private $view;

    public function __construct()
    {
        $this->view = Application::$app->getInstanceOfClasses('View');
        $this->view->setLayout('Auth');
    }


    public function loginGet(Request $request)
    {
        $user = new UserLogin;
        $user->loadData($request->getBody());
        $this->view->show('Login.php', ['model' => $user]);
    }

    public function loginPost(Request $request)
    {
        $user = new UserLogin;
        $user->loadData($request->getBody());
        if ($user->validate() && $user->Login()) {
            $id = $user->find(['email' => $user->email])['id'];
            Application::$app->getInstanceOfClasses('session')->set('email', $user->email);
            Application::$app->getInstanceOfClasses('session')->set('id', $id);
            Application::$app->getInstanceOfClasses('response')->redirect('/home');
        }
        $this->view->show('Login.php', ['model' => $user]);
    }

    public function register(Request $request)
    {
        $user = new UserRegister;
        $user->loadData($request->getBody());
        if ($request->isPost()) {

            if ($user->validate() && $user->save()) {
                $id = $user->find(['email' => $user->email])['id'];
                Application::$app->getInstanceOfClasses('session')->set('email', $user->email);
                Application::$app->getInstanceOfClasses('session')->set('id', $id);
                Application::$app->getInstanceOfClasses('response')->redirect('/home');
            }

            return $this->view->show('Register.php', [
                'model' => $user
            ]);
        }

        return $this->view->show('Register.php', [
            'model' => $user
        ]);
    }
}