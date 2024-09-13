<?php declare(strict_types=1);

use App\App;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/configs/path_constants.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// $container = require CONFIG_PATH . '/container/container.php';
// $addMiddlewares = require CONFIG_PATH . '/middleware.php';

// AppFactory::setContainer($container);

// $app = AppFactory::create();

// $addMiddlewares($app);

// return $app;

$container = require CONFIG_PATH . '/container/container.php';

return $container;  // This will return the Container itself. We can, then, get the App instance from the container, in public>index.php.
