<?php

class m0001_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE `user` (
              `id` SERIAL,
              `firstname` tinytext NOT NULL,
              `lastname` tinytext NOT NULL,
              `email` tinytext NOT NULL,
              `password` tinytext NOT NULL,
              `status` tinyint(1) NOT NULL DEFAULT 1,
              `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
              `is_staff` tinyint(1) NOT NULL DEFAULT 0,
              `is_active` tinyint(1) NOT NULL DEFAULT 1,
              `is_super_admin` tinyint(1) NOT NULL DEFAULT 0
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS `user`";
        $db->pdo->exec($SQL);
    }
}