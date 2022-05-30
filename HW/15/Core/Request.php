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
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if (array_key_exists('_method', $_POST)) {
            return $_POST['_method'];
        }
        if (array_key_exists('_method', $_GET)) {
            return $_GET['_method'];
        }
        return $method;
    }

    public function isPost()
    {
        return $this->getMethod() === 'post';
    }

    public function isGet()
    {
        return $this->getMethod() === 'get';
    }

    public function getBody($method = '')
    {
        $body = [];

        if ($this->getMethod() === 'post' || $method === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }elseif ($this->getMethod() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }else {
            return $_POST;
        }

        return $body;
    }

    public function getFile()
    {
        return $_FILES;
    }

}