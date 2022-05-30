<?php

namespace Core\DB;


use Core\Application;
use PDO;

class MySqlDatabaseConnection implements DatabaseConnectionInterface
{

    private static $pdo;
    private static $instanse = null;
    private $queryBulider;
    private $root;

    private function __construct()
    {
        $this->queryBulider = new MySqlDatabase($this); 
        $this->root = Application::$rootPath;
    }

    public static function getInstance()
    {
        if (self::$instanse === null) {
            return self::$instanse = new MySqlDatabaseConnection();
        }else {
            return self::$instanse; 
        }
    }

    public static function config(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        self::$pdo = new PDO($dsn, $user, $password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getPDO(){
        return self::$pdo;
    }

    public function applyMigration()
    {
        $this->CreateMigrationTable();
        $migrations = $this->getApplyedMigration();

        $newApplayed = [];
        $scanMigrations = scandir($this->root.'/Migrations');
        $scanMigrations = array_filter($scanMigrations, fn ($val) => $val !== '.' && $val !== '..');
        $needApply = array_diff($scanMigrations, $migrations);


        foreach ($needApply as $migration) {
            
            $migrationName = pathinfo($migration, PATHINFO_FILENAME);
            require_once $this->root."/Migrations/$migration";
            (new $migrationName)->up();
            $newApplayed[] = $migration;
            
        }
        
        if (!empty($newApplayed)) {
            $this->saveMigration($newApplayed);
        }

    }

    public function CreateMigrationTable()
    {
        $this->queryBulider->setStatment('CREATE TABLE IF NOT EXISTS migrations (id INT AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) ENGINE=INNODB;')->exec();
    }

    public function getApplyedMigration()
    {
        return $this->queryBulider->table('migrations')->select(['migration'])->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigration(array $migrations, $col_name = 'migration')
    {
        array_walk($migrations, fn($val) => $this->queryBulider->table('migrations')->insert([$col_name => $val])->exec());
    }
}

