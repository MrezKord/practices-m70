<?php

use Core\Application;

class m0002_migration
{

    public function up()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')
        ->setStatment("ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL")->exec();
    }

    public function down()
    {
        Application::$app->getInstanceOfClasses('MySqlDatabase')
        ->setStatment("ALTER TABLE users DROP COLUMN password")->exec();
    }
}