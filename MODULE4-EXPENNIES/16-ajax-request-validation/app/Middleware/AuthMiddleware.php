<?php declare(strict_types=1);

namespace App\Middleware;

use App\Contracts\AuthInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Views\Twig;

class AuthMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly ResponseFactoryInterface $responseFactory, private readonly AuthInterface $auth, private readonly Twig $twig) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        if ($user = $this->auth->user()) {

        $this->twig->getEnvironment()->addGlobal('auth', ['id' => $user->getId(), 'name' => $user->getName()]);

        return $handler->handle($request->withAttribute('user', $this->auth->user()));
        }
        
        return $this->responseFactory->createResponse()->withHeader('Location', '/login')->withStatus(302);
    }
}
