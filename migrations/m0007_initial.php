<?php

class m0007_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "ALTER TABLE `user` add is_active boolean not null default 1;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "ALTER TABLE `user` drop is_active;";
        $db->pdo->exec($SQL);
    }
}