<?php declare(strict_types=1);

use App\Config;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    $config = $container->get(Config::class);

    // Twig
    $app->add(TwigMiddleware::create($app, $container->get(Twig::class)));

    // Custom Validation Exception Middleware:
    $app->add(\App\Middleware\ValidationExceptionMiddleware::class);

    // Custom Validation Errors Middleware:
    $app->add(\App\Middleware\ValidationErrorsMiddleware::class);

    // Session Middleware:
    $app->add(\App\Middleware\StartSessionsMiddleware::class);

    // Logger
    $app->addErrorMiddleware(
        (bool) $config->get('display_error_details'),
        (bool) $config->get('log_errors'),
        (bool) $config->get('log_error_details')
    );
};
