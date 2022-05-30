<?php

use Core\Application;

class m0005_migration
{

    public function up()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('CREATE TABLE Department (
            id INT  AUTO_INCREMENT  NOT NULL,
            name VARCHAR(255) NOT NULL,
            cost_ceiling VARCHAR(255) NOT NULL,
            user_active_day INT NOT NULL,
            creator_id INT NOT NULL,
            PRIMARY KEY (id),
            FOREIGN KEY (creator_id) REFERENCES Bosses(id));')->exec();  
    }

    public function down()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('DROP TABLE Department')->exec();
    }
}