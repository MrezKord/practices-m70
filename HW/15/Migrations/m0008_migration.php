<?php

use Core\Application;

class m0008_migration
{

    public function up()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('CREATE TABLE Visit (
            id INT  AUTO_INCREMENT  NOT NULL,
            `time` VARCHAR(255) NOT NULL,
            `day` VARCHAR(255) NOT NULL,
            doctor_id INT NOT NULL,
            patient_id INT NOT NULL,
            PRIMARY KEY (id),
            FOREIGN KEY (doctor_id) REFERENCES Doctors(id),
            FOREIGN KEY (patient_id) REFERENCES Patient(id)
          );')->exec();
    }


    public function down()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('DROP TABLE Visit')->exec();
    }
}