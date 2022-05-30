<?php

namespace Core;

use Core\DB\DatabaseConnectionInterface;
use Core\DB\DatabaseInterface;
use Core\DB\MySqlDatabaseConnection;
use Core\DB\MySqlDatabase;
use Dotenv\Util\Str;
use Medoo\Medoo;
use PDO;

class Application 
{
    public static $app;
    public static string $rootPath;

    private Router $router;
    private PDO $pdo;
    private View $View;
    private Response $response;
    private Session $session;
    private DatabaseInterface $MySqlDatabase;
    private DatabaseConnectionInterface $connection;
    private Medoo $medoo;

    public function __construct(array $config)
    {
        self::$rootPath = dirname(__DIR__);
        $this->View = new View();
        $this->router = new Router();
        $this->response = new Response();
        $this->session = new Session;
        MySqlDatabaseConnection::config($config['db']);
        $this->connection = MySqlDatabaseConnection::getInstance();
        $this->MySqlDatabase = new MySqlDatabase($this->connection);
        $this->medoo = new Medoo($config['medoo']);
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

    public function put($path, $callback)
    {
        $this->router->put($path, $callback);
    }
    
    public function delete($path, $callback)
    {
        $this->router->delete($path, $callback);
    }

    public function run()
    {
        $this->router->resolve();
    }

    public function getInstanceOfClasses($name)
    {
        return (!property_exists($this, $name)) ? false : $this->$name;
    }

    public function isGust()
    {
        return !isset($_SESSION['id']);
    }
}