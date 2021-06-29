<?php

class m0003_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "ALTER TABLE `contact` drop password;ALTER TABLE `contact` add subject tinytext not null;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "ALTER TABLE `contact` add password tinytext not null;ALTER TABLE `contact` drop subject;";
        $db->pdo->exec($SQL);
    }
}