<?php

class m0007_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "ALTER TABLE `user` ADD IF NOT EXISTS (is_super_admin BOOLEAN NOT NULL DEFAULT 0)" ;
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "ALTER TABLE `user` DROP IF EXISTS is_super_admin";
        $db->pdo->exec($SQL);
    }
}