<?php declare(strict_types=1);

namespace App\Middleware;

use App\Contracts\SessionInterface;
use App\Exception\ValidationException;
use App\ResponseFormatter;
use App\Services\RequestService;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly ResponseFactoryInterface $responseFactory, 
                                private readonly SessionInterface $session, 
                                private readonly RequestService $requestService,
                                private readonly ResponseFormatter $responseFormatter) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): Response
    {
        try {
            return $handler->handle($request);
        } catch (ValidationException $e) {
            
            $response = $this->responseFactory->createResponse();

            if ($this->requestService->isXhr($request)) {
                // return json response:
                return $this->responseFormatter->asJson($response->withStatus(422), $e->errors());
            }


            $referer = $this->requestService->getReferer($request);
            $oldData = $request->getParsedBody();

            // Use this Info/list to remove the 'password' and 'confirmPassword' fields from the old data, to avoid flashing sensitive information on the session.
            $sensitiveFields = ['password', 'confirmPassword'];

            // Flash errors and old form data to the session, so that it can be used in the template.
            $this->session->flash('errors', $e->errors());  // * flashes the errors to the session, so that they can be displayed in the template.
            $this->session->flash('old', array_diff_key($oldData, array_flip($sensitiveFields)));  // * flashes the old form data to the session, so that it can be displayed in the template, on validation errors.

            return $response->withHeader('Location', $referer)->withStatus(302);  // This will redirect the user back to the 'register' page (the page that the user was trying to access, to be more precise)...
        }
    }
}
