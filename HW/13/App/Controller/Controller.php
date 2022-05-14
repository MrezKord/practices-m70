<?php

namespace App\Controller;

use Core\Request;
use Core\View;
use Core\Application;


class Controller
{

    private $view;

    public function __construct()
    {
        $this->view = Application::$app->getInstanceOfClasses('View');
        $this->view->setLayout('Main');           
    }

    public function home()
    {
        $this->view->show("Home.php", ['name' => 'reza']);
    }

    public function Contact()
    {
        $this->view->show("Contact.php", ['name' => 'reza']);
    }

    public function start()
    {
        echo $this->view->showOnly("Start.php");
    }

    public function dataContact(Request $request)
    {
        print_r($request->getBody());
    }
}
