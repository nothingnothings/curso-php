<?php declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GuestMiddleware implements MiddlewareInterface
{
    public function __construct(private ResponseFactoryInterface $responseFactory) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        if (!empty($_SESSION['user'])) {
            return $this->responseFactory->createResponse()->withHeader('Location', '/')->withStatus(302);
        }

        return $handler->handle($request);
    }
}
