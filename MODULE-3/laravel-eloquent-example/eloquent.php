<?php declare(strict_types=1);

use Dotenv\Dotenv;

require_once './vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

$capsule = new Capsule;

$params = [
    'host' => $_ENV['DB_HOST'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'database' => $_ENV['DB_DATABASE'],
    'driver' => $_ENV['DB_DRIVER'] ?? 'mysql',
    'port' => $_ENV['DB_PORT'] ?? 3307,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
];

$capsule->addConnection($params);

// Set the event dispatcher used by Eloquent's models:
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
