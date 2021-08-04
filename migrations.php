<?php


use tn\phpmvc\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ],
    'mail' => [
        'host' => $_ENV['MAIL_HOST'],
        'username' => $_ENV['MAIL_USERNAME'],
        'password' => $_ENV['MAIL_PASSWORD'],
        'port' => $_ENV['MAIL_PORT'],
    ]
];

$app = new Application(__DIR__, $config);

$app->db->applyMigrations();

