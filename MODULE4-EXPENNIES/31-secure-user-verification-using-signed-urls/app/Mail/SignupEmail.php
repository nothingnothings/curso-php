<?php declare(strict_types=1);

namespace App\Mail;

use App\Config;
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
        private readonly RouteParserInterface $routeParser
    ) {}


    public function send(string $email): void
    {   
        // ? activationLink format: {BASE_URL}/verify/{USER_ID}/{EMAIL_HASH}?expiration={EXPIRATION_TIMESTAMP}&signature={SIGNATURE}
        $activationLink = $this->generateSignedUrl();
        $from = $this->config->get('mailer.from');
        $to = $email;
        $subject = 'Welcome to ' . $this->config->get('app_name');


        // * Send email to user.
        $message = (new TemplatedEmail())
                    ->from($from)
                    ->to($to)
                    ->subject($subject)
                    ->htmlTemplate('/emails/signup.html.twig')
                    ->context([
                        'activationLink' => $activationLink,
                        'expirationDate' => new \DateTime('+30 minutes'),
                    ]);

                
        $this->renderer->render($message);

        $this->mailer->send($message);
    }

    // * Returns the activationLink
    private function generateSignedUrl(int $userId, string $email, DateTime $expirationDate): string
    {
    // activationLink format: {BASE_URL}/verify/{USER_ID}/{EMAIL_HASH}?expiration={EXPIRATION_TIMESTAMP}&signature={SIGNATURE}

    $expirationTimestamp = $expirationDate->getTimestamp();
    $routeParams = [ 'id' => $userId, 'hash' => sha1($email) ];
    $queryParams = [ 'expiration' => $expirationTimestamp ];
    $baseUrl = trim($this->config->get('app_url'), '/');

    // {BASE_URL}/verify/{USER_ID}/{EMAIL_HASH}?expiration={EXPIRATION_TIMESTAMP} - THIS WILL BE USED TO GENERATE THE SIGNATURE.
    $url = $baseUrl . $this->routeParser->urlFor('verify', $routeParams, $queryParams);

    // Arguments: 1) hashing algorithm, 2) url, 3) secret key.
    $signature = hash_hmac('sha256', $url, $this->config->get('app_key'));

    /// {BASE_URL}/verify/{USER_ID}/{EMAIL_HASH}?expiration={EXPIRATION_TIMESTAMP}&signature={SIGNATURE}
    $activationLink = $baseUrl . $this->routeParser->urlFor('verify', $routeParams, $queryParams) . '&signature=' . $signature;

    return $activationLink;
    }
}
