<?php declare(strict_types=1);

namespace App\Middleware;

use App\Exception\ValidationException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Factory\ResponseFactory;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function __construct(private ResponseFactory $responseFactory) {}

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        try {
            return $handler->handle($request);
        } catch (ValidationException $e) {
            $response = $this->responseFactory->createResponse();

            $referer = $request->getServerParams()['HTTP_REFERER'];  // * gets the 'Referer' header, which contains the URL of the page that the user was trying to access.
            $oldData = $request->getParsedBody();

            // Use this Info/list to remove the 'password' and 'confirmPassword' fields from the old data, to avoid flashing sensitive information on the session.
            $sensitiveFields = ['password', 'confirmPassword'];

            $_SESSION['errors'] = $e->errors();  // * stores the errors in the $_SESSION superglobal, so that they can be displayed in the template.
            $_SESSION['old'] = array_diff_key($oldData, array_flip($sensitiveFields));  // * stores the old form data in the $_SESSION superglobal, so that it can be displayed in the template, on validation errors.

            return $response->withHeader('Location', $referer);  // This will redirect the user back to the 'register' page (the page that the user was trying to access, to be more precise)...
        }
    }
}
