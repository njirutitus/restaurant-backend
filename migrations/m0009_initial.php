<?php

class m0009_initial
{
    public function up()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS order_item(
        id SERIAL,
        order_id BIGINT UNSIGNED NOT NULL,
        item_id BIGINT UNSIGNED NOT NULL,
        item_price DOUBLE NOT NULL, 
        quantity TINYINT NOT NULL DEFAULT 1,
        added_on TIMESTAMP NOT NULL,
        FOREIGN KEY(`order_id`) REFERENCES orders(id) ON DELETE RESTRICT ON UPDATE CASCADE,
        FOREIGN KEY(`item_id`) REFERENCES menu(id) ON DELETE RESTRICT ON UPDATE CASCADE
        )" ;
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \tn\phpmvc\Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS order_items";
        $db->pdo->exec($SQL);
    }
}