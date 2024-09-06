<?php declare(strict_types=1);

use Slim\App;

// $app    = require __DIR__ . '/../bootstrap.php';
// $router = require CONFIG_PATH . '/routes/web.php';

// $router($app);

$container = require __DIR__ . '/../bootstrap.php';

$app = $container->get(App::class);

$app->run();
