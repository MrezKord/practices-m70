<?php

use Core\Application;

class m0001_migration
{
    
    public function up()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
              email VARCHAR(255) NOT NULL,
              firstName VARCHAR(255) NOT NULL,
              lastName VARCHAR(255) NOT NULL,
              role VARCHAR(255) NOT NULL,
              status TINYINT NOT NULL,
              create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  
            ) ENGINE=INNODB;')->exec();
    }

    public function down()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('DROP TABLE users')->exec();
    }
}