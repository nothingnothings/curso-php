<?php declare(strict_types=1);

use App\App;
use App\Container;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = new Container();

(new App(
    $container
))->boot();  // We just want it to boot, and not run a router/server.

$container->get(\App\Services\EmailService::class)->sendQueuedEmails();
