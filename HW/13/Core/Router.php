<?php

namespace Core;

use App\Controller\Controller;
class Router
{

    private $route = [];
    private Request $request;

    public function __construct()
    {
        $this->request = Request::getInstance();
    }

    public function get($path, $callback)
    {
        $this->route['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->route['post'][$path] = $callback;
    }

    public function resolve()
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();

        $callback = $this->route[$method][$path] ?? null;

        if (is_null($callback)) {
            Application::$app->getInstanceOfClasses('response')->setResponseCode(404);
            echo Application::$app->getInstanceOfClasses('View')->showOnly("_404.php", []);
            exit;
        }
        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        call_user_func($callback, $this->request);
    }
}