<?php

use Core\Application;

class m0007_migration
{

    public function up()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('CREATE TABLE working_time (
            id INT  AUTO_INCREMENT  NOT NULL,
            doctor_id INT NOT NULL,
            Sun VARCHAR(255) ,
            Mon VARCHAR(255) ,
            Tues VARCHAR(255) ,
            Wed VARCHAR(255) ,
            Thurs VARCHAR(255) ,
            Fri VARCHAR(255) ,
            Sat VARCHAR(255) ,
            PRIMARY KEY (id)
          );')->exec();
    }

    public function down()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('DROP TABLE `working_time`')->exec();
    }
}