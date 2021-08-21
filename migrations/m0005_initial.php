<?php

class m0005_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "ALTER TABLE `user_token` ADD (used BOOLEAN NOT NULL DEFAULT 0)" ;
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "ALTER TABLE user_token DROP IF EXISTS used";
        $db->pdo->exec($SQL);
    }
}