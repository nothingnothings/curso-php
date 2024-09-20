<?php declare(strict_types = 1);




namespace App\Controllers;

use App\Contracts\RequestValidatorFactoryInterface;
use App\Contracts\UserProviderServiceInterface;
use App\RequestValidators\ForgotPasswordRequestValidator;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class PasswordResetController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
        private readonly UserProviderServiceInterface $userProviderService
    )
    {
    }

    public function showForgotPasswordForm(Request $request, Response $response): Response
    {
        return $this->twig->render($response, 'auth/forgot_password.twig');
    }

    public function handleForgotPasswordRequest(Request $request, Response $response): Response
    {
       
        $data = $this->requestValidatorFactory->make(ForgotPasswordRequestValidator::class)->validate(
            $request->getParsedBody()
        );

        $user = $this->userProviderService->getByCredentials($data);

        return $response;
    }
}   