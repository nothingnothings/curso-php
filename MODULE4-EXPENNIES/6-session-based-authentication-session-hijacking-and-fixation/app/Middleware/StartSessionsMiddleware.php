<?php declare(strict_types=1);

namespace App\Middleware;

use App\Exception\SessionException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Factory\ResponseFactory;

class StartSessionsMiddleware implements MiddlewareInterface
{
    public function __construct(private ResponseFactory $responseFactory) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionException('Session already started.');
        }

        if (headers_sent($filename, $line)) {  // these variables can be empty.
            throw new SessionException('Headers already sent.');
        }

        // * This increases the security of the application, by making it harder for attackers to hijack the session.
        session_set_cookie_params(['secure' => true, 'httponly' => true, 'samesite' => 'lax']);

        session_start();

        $response = $handler->handle($request);

        session_write_close();

        return $response;
    }
}
