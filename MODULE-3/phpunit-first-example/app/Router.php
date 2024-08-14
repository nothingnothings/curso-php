<?php

declare(strict_types=1);


namespace App;

use App\Exceptions\RouteNotFoundException;

class Router
{

    private array $routes = [];

    // * Call it like '$router->register('GET /foo', function() { ... });'
    public function register(string $requestMethod, string $route, callable|array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }

    // * This is used to call the 'register' method for the 'get' request method routes:
    public function get(string $route, callable|array $action): self
    {

        return $this->register('get', $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register('post', $route, $action);
    }

    public function delete(string $route, callable|array $action): self
    {
        return $this->register('delete', $route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }



    public function resolve(string $requestUri, string $requestedMethod)
    {

        // * The first part of the request URI is the route (the second part is the query string/parametrs)
        $route = explode('?', $requestUri)[0];

        // * Find the action for the route, in the routes array.
        $action = $this->routes[$requestedMethod][$route] ?? null;

        if (!$action) {
            // Throw custom exception.
            throw new RouteNotFoundException();
        }


        if (is_callable($action)) {
            return call_user_func($action, $route);
        }

        // * If it is not callable, it must be an array:
        if (is_array($action)) {
            [$class, $method] = $action;
            if (class_exists($class)) {
                $class = new $class();
                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }

        throw new RouteNotFoundException();

    }
}

