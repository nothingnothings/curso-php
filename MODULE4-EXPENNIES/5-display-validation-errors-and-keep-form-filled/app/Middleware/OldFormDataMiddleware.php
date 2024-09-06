<?php declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Views\Twig;

class OldFormDataMiddleware implements MiddlewareInterface {
    public function __construct(private ResponseFactory $responseFactory, private readonly Twig $twig) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {

        if (!empty($_SESSION['old'])) { // insert errors, if any, into the twig template global (errors taken from the $_SESSION superglobal).

            $old = $_SESSION['old'];


            $this->twig->getEnvironment()->addGlobal('old', $old);
            unset($_SESSION['old']); /// We do this so that the errors are 'flashed' (in other words, they disappear after being shown only once).

        }

        return $handler->handle($request);
    }
}
