<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Contracts\SessionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Views\Twig;

class ValidationErrorsMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly SessionInterface $session, private readonly ResponseFactory $responseFactory, private readonly Twig $twig) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {

        if ($errors = $this->session->getFlash('errors')) { // insert errors, if any, into the twig template global (errors taken from the $_SESSION superglobal).
            $this->twig->getEnvironment()->addGlobal('errors', $errors); 
        }

        return $handler->handle($request);
    }
}