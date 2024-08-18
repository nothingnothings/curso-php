<?php declare(strict_types=1);

namespace App;

use App\Attributes\Route;
use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes = [];

    public function __construct(private Container $container) {}

    public function registerRoutesFromControllerAttributes(array $controllers)
    {
        // * With this, we get access to each controller object of our app.
        foreach ($controllers as $controller) {
            $reflectionController = new \ReflectionClass($controller);

            // * Get all methods, of each controller.
            foreach ($reflectionController->getMethods() as $method) {
                // * Get all attributes related to the 'Route' attribute, routing-related, of each method.
                $attributes = $method->getAttributes(Route::class);
            }
        }
    }

    public function register(string $requestMethod, string $route, callable|array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register('get', $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register('post', $route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }

    public function resolve(string $requestUri, string $requestMethod)
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;

        if (!$action) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        [$class, $method] = $action;

        if (class_exists($class)) {
            $class = $this->container->get($class);

            if (method_exists($class, $method)) {
                return call_user_func_array([$class, $method], []);
            }
        }

        throw new RouteNotFoundException();
    }
}
