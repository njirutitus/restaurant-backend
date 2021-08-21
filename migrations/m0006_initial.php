<?php

class m0006_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "ALTER TABLE `contact` ADD (name TINYTEXT NOT NULL)" ;
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "ALTER TABLE contact DROP IF EXISTS name";
        $db->pdo->exec($SQL);
    }
}