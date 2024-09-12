<?php declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\CategoriesController;
use App\Controllers\HomeController;
use App\Controllers\TransactionsController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;

return function (App $app) {
    $app->get('/', [HomeController::class, 'index'])->add(AuthMiddleware::class);

    $app->group('', function (RouteCollectorProxy $guest) {
        $guest->get('/login', [AuthController::class, 'loginView']);
        $guest->get('/register', [AuthController::class, 'registerView']);
        $guest->post('/login', [AuthController::class, 'login']);
        $guest->post('/register', [AuthController::class, 'register']);
    })->add(GuestMiddleware::class);

    $app->post('/logout', [AuthController::class, 'logOut'])->add(AuthMiddleware::class);

    $app->group('/categories', function (RouteCollectorProxy $categories) {
        $categories->get('', [CategoriesController::class, 'index']);
        $categories->post('', [CategoriesController::class, 'store']);
        $categories->get('/load', [CategoriesController::class, 'load']);
        // If the id is not an integer, this route won't be reached, because the route is defined, with a regular expression, as '/{id:[0-9]+}'.
        $categories->delete('/{id:[0-9]+}', [CategoriesController::class, 'delete']);
        $categories->get('/{id:[0-9]+}', [CategoriesController::class, 'get']);
        $categories->post('/{id:[0-9]+}', [CategoriesController::class, 'update']);
    })->add(AuthMiddleware::class);

    $app->group('/transactions', function (RouteCollectorProxy $transactions) {
        $transactions->get('', [TransactionsController::class, 'index']);
        $transactions->post('', [TransactionsController::class, 'store']);
        $transactions->get('/load', [TransactionsController::class, 'load']);
        // If the id is not an integer, this route won't be reached, because the route is defined, with a regular expression, as '/{id:[0-9]+}'.
        $transactions->delete('/{id:[0-9]+}', [TransactionsController::class, 'delete']);
        $transactions->get('/{id:[0-9]+}', [TransactionsController::class, 'get']);
        $transactions->post('/{id:[0-9]+}', [TransactionsController::class, 'update']);
    })->add(AuthMiddleware::class);
};
