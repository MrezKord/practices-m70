<?php

namespace Authenticate;

class Validation 
{
    private static string $target;
    private static array $methods;
    private static $instance = null;

    private function __construct(){}

    public static function getInstance()
    {
        if (self::$instance === null) {
            return self::$instance = new Validation();
        }else {
            return self::$instance;
        }
    }

    public function Validation(string $target, array $methods)
    {
        self::$methods = $methods;
        self::$target = $target;
        try {
            foreach ($methods as $value) {
                if (!$this->$value()) {
                    echo " $value is invalid ";
                    break;
                }else {
                    return $this->$value();
            
                }
            }
        } catch (\Throwable $th) {
            throw new \Exception("Method not found", 1);
        }
    }

    private function username()
    {
        $flag = false;
        if(preg_match('/[a-zA-Z0-9]{5,}/', self::$target)){
            $flag = true;
        }

        return true;
    }

    private function email(){
        $flag = false;
        if (filter_var(self::$target, FILTER_VALIDATE_EMAIL)) {
            $flag = true;
        }

        return $flag;

    }

}