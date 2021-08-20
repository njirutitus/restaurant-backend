<?php


use tn\phpmvc\Application;

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

if($argc > 1) {
    $command = strtolower($argv[1]);
    switch ($command) {
        case 'runmigrations':
            $app->db->applyMigrations();
            break;
        case 'createsuperadmin':
            $app->db->createSuperAdmin();
            break;
        default:
            echo "Unrecognised argument!!!\n";
            echo "Note: use runmigrations to run migrations, createsuperadmin to create a super admin user\n";
    }
}
else {
    echo "Oops! seems you forgot to supply an argument\n";
    echo "Note: use runmigrations to run migrations, createsuperadmin to create a super admin user\n";
}

