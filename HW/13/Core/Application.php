<?php

namespace Core;
use Core\DB\Database;

class Application 
{
    public static $app;

    private Router $router;
    private Database $database;
    private View $View;
    private Response $response;

    public function __construct(array $config)
    {
        $this->View = new View();
        $this->router = new Router();
        $this->response = new Response();
        Database::config($config);
        $this->database = Database::getInstance();
        self::$app = $this;
    }

    public function get($path, $callback)
    {
        $this->router->get($path, $callback);
    }

    public function post($path, $callback)
    {
        $this->router->post($path, $callback);
    }

    public function run ()
    {
        $this->router->resolve();
    }

    public function getInstanceOfClasses($name)
    {
        return (!property_exists($this, $name)) ? false : $this->$name;
    }
}