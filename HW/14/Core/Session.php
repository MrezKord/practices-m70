<?php

namespace Core;

class Session
{

    public function __construct()
    {
        session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function unSet($key)
    {
        unset($_SESSION[$key]);
    }
}