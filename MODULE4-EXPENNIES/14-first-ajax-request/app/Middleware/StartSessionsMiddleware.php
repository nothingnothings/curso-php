<?php declare(strict_types=1);

namespace App\Middleware;

use App\Contracts\SessionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class StartSessionsMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly SessionInterface $session) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {   

        $this->session->start();

        $response = $handler->handle($request);

        if ($request->getMethod() === 'GET') {
            $this->session->put('previousUrl', (string) $request->getUri());
        }

        $this->session->save();

        return $response;
    }


}
