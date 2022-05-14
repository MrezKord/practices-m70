<?php

namespace Core;

class Request 
{

    private static $instance = null;

    private function __construct(){}

    public static function getInstance()
    {
        if (self::$instance === null) {
            return self::$instance = new Request;
        }else {
            return self::$instance;
        }
    }

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'];
        $key = strpos($path, '?');
        $path = ($key == false) ? $path : substr($path, 0, $key);
        return $path;
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost()
    {
        return $this->getMethod() === 'post';
    }

    public function isGet()
    {
        return $this->getMethod() === 'get';
    }

    public function getBody()
    {

        $body = [];

        if ($this->getMethod() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->getMethod() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}