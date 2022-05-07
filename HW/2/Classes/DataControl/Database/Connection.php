<?php

namespace DataControl\Database;

use PDO;

class Connection
{
    private static $instance = null;
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbName = 'reza';
    private PDO $pdo;

    private function __construct()
    {
        $dns = 'mysql:host='.$this->host.';dbname='.$this->dbName;
        $this->pdo = new PDO($dns, $this->user, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            return self::$instance = new Connection();
        }else {
            return self::$instance;
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }

}