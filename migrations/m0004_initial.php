<?php

class m0004_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS `user_token` (
        `id` SERIAL,
        `user` BIGINT UNSIGNED NOT NULL,
        `token` MEDIUMTEXT,
        `expires_at` DATETIME NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        FOREIGN KEY(`user`) REFERENCES user(id) ON DELETE RESTRICT ON UPDATE CASCADE
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS user_token";
        $db->pdo->exec($SQL);
    }
}