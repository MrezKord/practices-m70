<?php

use Core\Application;

class m0003_migration
{

    public function up()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('CREATE TABLE Doctors (
            id INT  AUTO_INCREMENT  NOT NULL,
            education VARCHAR(255) NOT NULL,
            profile_photo VARCHAR(255) NOT NULL,
            department VARCHAR(255) NOT NULL,
            specialty VARCHAR(255) NOT NULL,
            history TEXT,
            cost VARCHAR(255) NOT NULL,
            address TEXT,
            phone VARCHAR(255) NOT NULL,
            user_id INT NOT NULL,
            PRIMARY KEY (id)
          );')->exec();  
    }

    public function down()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('DROP TABLE Doctors')->exec();
    }
}