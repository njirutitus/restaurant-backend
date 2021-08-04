<?php

class m0003_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS `menu` (
        `id` SERIAL,
        `title` tinytext NOT NULL,
        `category` tinytext NOT NULL,
        `price` double NOT NULL,
        `img` text NOT NULL,
        `desc` text NOT NULL DEFAULT 1,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS menu";
        $db->pdo->exec($SQL);
    }
}