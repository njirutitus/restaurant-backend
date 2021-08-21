<?php


use tn\phpmvc\Application;

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();


if (!getenv('DB_DSN')) {
    putenv("DB_DSN=$_ENV[DB_DSN]");
    putenv("DB_USER=$_ENV[DB_USER]");
    putenv("DB_PASSWORD=$_ENV[DB_PASSWORD]");
    putenv("MAIL_HOST=$_ENV[MAIL_HOST]");
    putenv("MAIL_USERNAME=$_ENV[MAIL_USERNAME]");
    putenv("MAIL_PASSWORD=$_ENV[MAIL_PASSWORD]");
    putenv("MAIL_PORT=$_ENV[MAIL_PORT]");

}

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => getenv('DB_DSN'),
        'user' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD')
    ],
    'mail' => [
        'host' => getenv('MAIL_HOST'),
        'username' => getenv('MAIL_USERNAME'),
        'password' => getenv('MAIL_PASSWORD'),
        'port' => getenv('MAIL_PORT'),
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

