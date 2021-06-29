<?php

class m0004_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "ALTER TABLE `contact` add body text not null;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "ALTER TABLE `contact` drop body;";
        $db->pdo->exec($SQL);
    }
}