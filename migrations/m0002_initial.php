<?php

class m0002_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE `contact` (
              `id` SERIAL,
              `name` tinytext NOT NULL,
              `email` tinytext NOT NULL,
              `subject` tinytext NOT NULL,
              `body` text NOT NULL,
              `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS `contact`";
        $db->pdo->exec($SQL);
    }
}