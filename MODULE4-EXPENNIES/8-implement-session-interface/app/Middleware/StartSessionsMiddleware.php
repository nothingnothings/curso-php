<?php declare(strict_types=1);

namespace App\Middleware;

use App\Contracts\SessionInterface;
use App\Exception\SessionException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class StartSessionsMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly SessionInterface $session) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {   

        if ($this->isActive()) {
            throw new SessionException('Session already started');
        }

        if (headers_sent($filename, $line)) {}

        $this->session->start();

        $response = $handler->handle($request);

        $this->session->save();

        return $response;
    }

    public function isActive(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }
}
