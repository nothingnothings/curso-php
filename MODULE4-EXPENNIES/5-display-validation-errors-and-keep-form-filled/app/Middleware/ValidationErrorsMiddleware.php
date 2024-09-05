<?php declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Views\Twig;

class ValidationErrorsMiddleware implements MiddlewareInterface
{
    public function __construct(private ResponseFactory $responseFactory, private readonly Twig $twig) {}

    public function process(Request $request, RequestHandlerInterface $handler):Response
    {

        if (isset($_SESSION['errors'])) {
         var_dump($_SESSION['errors']);
        } else {
            var_dump('EMPTY');
        }
           
        if(!empty($_SESSION['errors'])) { // insert errors, if any, into the twig template global (errors taken from the $_SESSION superglobal).
            var_dump($_SESSION['errors']);
            
            $this->twig->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
        }

        return $handler->handle($request);
    }
}
