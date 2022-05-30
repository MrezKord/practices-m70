<?php

use Core\Application;

class m0004_migration
{

    public function up()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('CREATE TABLE Bosses (
          id INT  AUTO_INCREMENT  NOT NULL,
          education VARCHAR(255) NOT NULL,
          profile_photo VARCHAR(255) NOT NULL,
          history TEXT,
          address TEXT,
          phone VARCHAR(255) NOT NULL,
          user_id INT NOT NULL,
          PRIMARY KEY (id)
        );')->exec();  
    }

    public function down()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('DROP TABLE Bosses')->exec();
    }
}