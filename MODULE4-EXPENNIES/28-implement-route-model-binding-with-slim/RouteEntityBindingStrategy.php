<?php declare(strict_types=1);

namespace App;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\InvocationStrategyInterface;

class RouteEntityBindingStrategy implements InvocationStrategyInterface
{
    public function __invoke(
        callable $callable,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $routeArguments
    ): ResponseInterface {
        $callableReflection = $this->createReflectionForCallable($callable);

        return $callable($request, $response, $routeArguments);  // * This is the default route strategy implementation of Slim framework (a request and response objects, and optional array of args)
    }

    // What this does: it creates a ReflectionMethod object for the callable, so that we can get the class name and method name from it.
    public function createReflectionForCallable(callable $callable): \ReflectionFunctionAbstract
    {
        return is_array($callable)
            ? new \ReflectionMethod($callable[0], $callable[1])  // Class, Method()
            : new \ReflectionFunction($callable);  // Function()
    }
}
