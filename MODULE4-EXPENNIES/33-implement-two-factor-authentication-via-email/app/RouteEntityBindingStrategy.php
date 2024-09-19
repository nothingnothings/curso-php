<?php declare(strict_types=1);

namespace App;

use App\Contracts\EntityManagerServiceInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\InvocationStrategyInterface;

class RouteEntityBindingStrategy implements InvocationStrategyInterface
{
    public function __construct(
    private readonly EntityManagerServiceInterface $entityManagerService,
    private readonly ResponseFactoryInterface $responseFactory
    ) {}

    public function __invoke(
        callable $callable,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $routeArguments
    ): ResponseInterface {
        $callableReflection = $this->createReflectionForCallable($callable);
        $resolvedArguments = [];

        foreach ($callableReflection->getParameters() as $parameter) {
            $type = $parameter->getType();

            if (!$type) {
                continue;
            }

            $paramName = $parameter->getName();
            $typeName = $type->getName();

            if ($type->isBuiltin()) {
                if ($typeName === 'array' && $paramName === 'args') {
                    $resolvedArguments[] = $routeArguments;
                }
            } else {
                if ($typeName === ServerRequestInterface::class) {
                    $resolvedArguments[] = $request;
                } elseif ($typeName === ResponseInterface::class) {
                    $resolvedArguments[] = $response;
                } else {
                    $entityId = (int) $routeArguments[$paramName] ?? null;

                    if (!$entityId || $parameter->allowsNull()) {
                        throw new \InvalidArgumentException("Unable to resolve argument '$paramName' in the callable.");
                    }


                    $entity = $this->entityManagerService->find($typeName, $entityId); // Get the desired entity (Transaction, Receipt, User, Category, etc)

                    if (! $entity) {
                        return $this->responseFactory->createResponse(404, 'Resource not found'); 
                    }

                    $resolvedArguments[] = $entity;
                }
            }
        }

        // return $callable($request, $response, $routeArguments);  // * This is the default route strategy implementation of Slim framework (a request and response objects, and optional array of args)
        return $callable(...$resolvedArguments); // * This is our custom Route strategy, with entity injection in the routes.
    }

    // What this does: it creates a ReflectionMethod object for the callable, so that we can get the class name and method name from it.
    public function createReflectionForCallable(callable $callable): \ReflectionFunctionAbstract
    {
        return is_array($callable)
            ? new \ReflectionMethod($callable[0], $callable[1])  // Class, Method()
            : new \ReflectionFunction($callable);  // Function()
    }
}
