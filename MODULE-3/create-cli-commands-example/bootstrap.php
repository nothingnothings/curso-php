<?php declare(strict_types=1);

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/configs/path_constants.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// * Create Container, using PHP-DI (with custom bindings):
$container = require CONFIG_PATH . '/container.php';

AppFactory::setContainer($container);

$app = AppFactory::create();

return $app;
