<?php

class m0005_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS comment(
        id SERIAL,
        menu BIGINT UNSIGNED NOT NULL,
        comment TEXT NOT NULL,
        author BIGINT UNSIGNED NOT NULL,
        date TIMESTAMP NOT NULL,
        FOREIGN KEY(menu) REFERENCES menu(id) ON DELETE RESTRICT ON UPDATE CASCADE,
        FOREIGN KEY(author) REFERENCES user(id) ON DELETE RESTRICT ON UPDATE CASCADE
        )" ;
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS comment";
        $db->pdo->exec($SQL);
    }
}