<?php declare(strict_types=1);

namespace App\Mail;

use App\Config;
use App\Entity\User;
use App\SignedUrl;
use DateTime;
use Slim\Interfaces\RouteParserInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\BodyRendererInterface;

class SignupEmail
{
    public function __construct(
        private readonly Config $config,
        private readonly MailerInterface $mailer,
        private readonly BodyRendererInterface $renderer,
        private readonly SignedUrl $signedUrl
    ) {}


    public function send(User $user): void
    {   
        // ? activationLink format: {BASE_URL}/verify/{USER_ID}/{EMAIL_HASH}?expiration={EXPIRATION_TIMESTAMP}&signature={SIGNATURE}
        $userId = $user->getId();
        $from = $this->config->get('mailer.from');
        $to = $user->getEmail();
        $subject = 'Welcome to ' . $this->config->get('app_name');
        $expirationDate =  new \DateTime('+30 minutes');
        $routeParams = ['id' => $userId, 'hash' => sha1($to)];
        $activationLink = $this->signedUrl->fromRoute('verify',$routeParams, $expirationDate);


        // * Send email to user.
        $message = (new TemplatedEmail())
                    ->from($from)
                    ->to($to)
                    ->subject($subject)
                    ->htmlTemplate('/emails/signup.html.twig')
                    ->context([
                        'activationLink' => $activationLink,
                        'expirationDate' => $expirationDate,
                    ]);

                
        $this->renderer->render($message);

        $this->mailer->send($message);
    }

}
