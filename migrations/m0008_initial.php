<?php

class m0008_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS order_payment(
        id SERIAL,
        made_by BIGINT UNSIGNED NOT NULL,
        order_id BIGINT UNSIGNED NOT NULL,
        payment_method TINYTEXT NOT NULL,
        amount DOUBLE NOT NULL,
        payment_date TIMESTAMP NOT NULL DEFAULT current_timestamp(),
        transaction_id TINYTEXT NOT NULL,
        status TINYINT NOT NULL DEFAULT 0,
        FOREIGN KEY(`made_by`) REFERENCES user(id) ON DELETE RESTRICT ON UPDATE CASCADE,
        FOREIGN KEY(`order_id`) REFERENCES orders(id) ON DELETE RESTRICT ON UPDATE CASCADE
        )" ;
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS order_payment";
        $db->pdo->exec($SQL);
    }
}