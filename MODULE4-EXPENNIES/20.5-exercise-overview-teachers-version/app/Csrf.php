<?php declare(strict_types=1);

namespace App;

use Closure;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Factory\ResponseFactory;

class Csrf
{
    public function __construct(private readonly ResponseFactory $responseFactory) {}

    public function failureHandler(): Closure
    {
        return fn(ServerRequestInterface $request,
            RequestHandlerInterface $handler) => $this->responseFactory->createResponse()->withStatus(403);
    }
}
