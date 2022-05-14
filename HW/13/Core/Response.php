<?php

namespace Core;

class Response 
{

    public function setResponseCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $path)
    {
        header('Location: '.$path);
    }
}