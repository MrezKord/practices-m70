<?php

use Core\Application;

class m0006_migration
{

    public function up()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('CREATE TABLE `Patient` (
            `id` INT  AUTO_INCREMENT  NOT NULL,
            `profile_photo` VARCHAR(255) NOT NULL,
            `family_history` TEXT NOT NULL,
            `phone` VARCHAR(255) NOT NULL,
            `user_id` INT NOT NULL,
            PRIMARY KEY (`id`)
          ); ')->exec();
    }

    public function down()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')->setStatment('DROP TABLE `Patient`')->exec();
    }
}
