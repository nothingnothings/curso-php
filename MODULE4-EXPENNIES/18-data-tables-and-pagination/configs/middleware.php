<?php declare(strict_types=1);

use App\Config;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    $config = $container->get(Config::class);

    // Method Override Middleware:
    $app->add(\App\Middleware\MethodOverrideMiddleware::class);

    // CSRF fields in templates:
    $app->add(\App\Middleware\CsrfFieldsMiddleware::class);

    // CSRF protection:
    $app->add('csrf');

    // Twig
    $app->add(TwigMiddleware::create($app, $container->get(Twig::class)));

    // Custom Validation Exception Middleware:
    $app->add(\App\Middleware\ValidationExceptionMiddleware::class);

    // Custom Validation Errors Middleware:
    $app->add(\App\Middleware\ValidationErrorsMiddleware::class);

    // Custom Old Form Data Middleware:
    $app->add(\App\Middleware\OldFormDataMiddleware::class);

    // Session Middleware:
    $app->add(\App\Middleware\StartSessionsMiddleware::class);

    // Body Parser Middleware (so that csrf works with json and xhr requests):
    $app->addBodyParsingMiddleware();

    // Logger
    $app->addErrorMiddleware(
        (bool) $config->get('display_error_details'),
        (bool) $config->get('log_errors'),
        (bool) $config->get('log_error_details')
    );
};
