<?php

class m0007_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS orders(
        id SERIAL,
        ordered_by BIGINT UNSIGNED NOT NULL,
        phone_number TINYTEXT NOT NULL,
        table_number TINYINT NOT NULL,
        persons TINYINT NOT NULL DEFAULT 1,
        amount DOUBLE NOT NULL,
        vat DOUBLE NOT NULL DEFAULT 0,
        discount DOUBLE NOT NULL DEFAULT 0,
        order_date TIMESTAMP NOT NULL DEFAULT current_timestamp(),
        status TINYINT NOT NULL DEFAULT 0 /* 0 for pending payment, 1 for paid, 2 fulfilled, 3 cancelled */,
        FOREIGN KEY(`ordered_by`) REFERENCES user(id) ON DELETE RESTRICT ON UPDATE CASCADE
        )" ;
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS orders";
        $db->pdo->exec($SQL);
    }
}