<?php

namespace Core\DB;
use \PDO;

class Database
{
    private static PDO $pdo;
    private static $instance = null;

    private function __construct(){}

    public static function config(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        self::$pdo = new PDO($dsn, $user, $password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            return self::$instance = new Database();
        }
        else {
            return self::$instance;
        }
    }

}