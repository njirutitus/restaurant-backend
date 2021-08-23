<?php

class m0006_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS reservation(
        id SERIAL,
        reserved_by TINYTEXT NOT NULL,
        adults TINYINT NOT NULL DEFAULT 1,
        date DATE NOT NULL,
        time TIME NOT NULL,
        last_updated TIMESTAMP NOT NULL
        )" ;
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS reservation";
        $db->pdo->exec($SQL);
    }
}