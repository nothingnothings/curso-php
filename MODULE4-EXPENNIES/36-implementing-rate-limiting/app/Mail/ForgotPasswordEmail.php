<?php

declare(strict_types=1);

namespace App\Mail;

use App\Config;
use App\Entity\PasswordReset;
use App\SignedUrl;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\BodyRendererInterface;

class ForgotPasswordEmail
{
    public function __construct(
        private readonly Config $config,
        private readonly MailerInterface $mailer,
        private readonly BodyRendererInterface $renderer,
        private readonly SignedUrl $signedUrl
    ) {}

    public function send(PasswordReset $passwordReset): void
    {

        // ? activationLink format: {BASE_URL}/verify/{USER_ID}/{EMAIL_HASH}?expiration={EXPIRATION_TIMESTAMP}&signature={SIGNATURE}
        $from = $this->config->get('mailer.from');
        $to = $passwordReset->getEmail();
        $subject = 'Your Expennies Password Reset Instructions';
        $expirationDate = $passwordReset->getExpiration();
        $routeParams = ['token' => $passwordReset->getToken()];
        $resetLink = $this->signedUrl->fromRoute('password-reset', $routeParams, $expirationDate);


        // * Send email to user.
        $message = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->htmlTemplate('/emails/password_reset.html.twig')
            ->context([
                'resetLink' => $resetLink,
            ]);


        $this->renderer->render($message);

        $this->mailer->send($message);
    }
}
