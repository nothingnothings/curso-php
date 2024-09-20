<?php

declare(strict_types=1);




namespace App\Controllers;

use App\Contracts\RequestValidatorFactoryInterface;
use App\Contracts\UserProviderServiceInterface;
use App\Entity\PasswordReset;
use App\Exception\ValidationException;
use App\Mail\ForgotPasswordEmail;
use App\RequestValidators\ForgotPasswordRequestValidator;
use App\RequestValidators\ResetPasswordRequestValidator;
use App\Services\PasswordResetService;
use DateTime;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class PasswordResetController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly RequestValidatorFactoryInterface $requestValidatorFactory,
        private readonly UserProviderServiceInterface $userProviderService,
        private readonly ForgotPasswordEmail $forgotPasswordEmail,
        private readonly PasswordResetService $passwordResetService
    ) {}

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
        $email = $data['email'];

        if ($user) {

            $this->passwordResetService->deactivateAllPasswordResets($email);

            $resetPassword = $this->passwordResetService->generate($email);

            //send email 
            $this->forgotPasswordEmail->send($resetPassword);
        }

        return $response;
    }

    public function showResetPasswordForm(Request $request, Response $response, array $args): Response
    {
        $token = $args['token'];

        $passwordReset = $this->passwordResetService->findByToken($token);

        if (! $passwordReset) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        return $this->twig->render($response, 'auth/reset_password.twig', ['token' => $token]);
    }

    public function resetPassword(Request $request, Response $response, array $args): Response
    {
        $token = $args['token'];

        $passwordReset = $this->passwordResetService->findByToken($token);

        if (! $passwordReset) {
            throw new ValidationException(['confirmPassword' => ['The token is invalid or has expired.']]);
        }

        $data = $this->requestValidatorFactory->make(ResetPasswordRequestValidator::class)->validate(
            $request->getParsedBody()
        );

        $user = $this->userProviderService->getByCredentials(['email' => $passwordReset->getEmail()]);

        if (! $user) {
            throw new ValidationException(['confirmPassword' => ['The email does not exist in our records.']]);
        }

        $this->passwordResetService->updatePassword($user, $data['password']);

        return $response->withHeader('Location', '/login')->withStatus(302);
    }
}
