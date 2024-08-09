<?php 

declare(strict_types= 1);


namespace App19;


class Router {

    private array $routes = [];

    // * Call it like '$router->register('GET /foo', function() { ... });'
    public function register(string $route, callable|array $action): self {
        $this->routes[$route] = $action;

        return $this;
    }

    public function resolve(string $requestUri){

    // * The first part of the request URI is the route (the second part is the query string/parametrs)
        $route = explode('?', $requestUri)[0];

        // * Find the action for the route, in the routes array.
        $action = $this->routes[$route] ?? null;

        if (!$action) {
            // Throw custom exception.
            throw new \App19\Exceptions\RouteNotFoundException();
        }


        if (is_callable($action)) {
            return call_user_func($action, $route);
        }

        // * If it is not callable, it must be an array:
        if(is_array($action)) {
            [$class, $method] = $action;

            if (class_exists($class)) {
                $class = new $class;
                
                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method],[]);
                }
            
            }


        }

        throw new \App19\Exceptions\RouteNotFoundException();
    }
}

