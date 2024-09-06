<?php declare(strict_types=1);

namespace App\Middleware;

use App\Contracts\AuthInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

// class AuthenticateUserMiddleware implements MiddlewareInterface
// {
//     public function __construct(private ResponseFactoryInterface $responseFactory, private EntityManager $entityManager) {}

//     public function process(Request $request, RequestHandlerInterface $handler): Response
//     {
//         // * If the user is logged in, we can get the user from the database, its entity, and then attach it to the request.
//         if (!empty($_SESSION['user'])) {

//             $user = $this->entityManager->getRepository(User::class)->find($_SESSION['user']);

//             $request = $request->withAttribute('user', $user);
//         }

//         return $handler->handle($request);
//     }
// }


class AuthenticateUserMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly AuthInterface $auth) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        return $handler->handle($request->withAttribute('user', $this->auth->user()));
    }
}