<?php declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Services\EmailService;
use App\View;
use Symfony\Component\Mailer\MailerInterface;

class UserController
{
    public function __construct(protected MailerInterface $mailer) {}

    #[Get('/users/create')]
    public function create(): View
    {
        return View::make('users/register');
    }

    #[Post('/users')]
    public function register()
    {
        $firstName = $_POST['name'];
        $emailAddress = $_POST['email'];

        $text = <<<Body

                    Hello $firstName,

                    Thank you for registering with us. We will be in touch with you shortly.

                    Best Regards,

                    Your Company
            Body;

        $html = <<<Body
                    <h1 style="text-align: center; color: blue;">Welcome</h1>
                    Hello $firstName,
                    <br /
                    Thank you for registering with us. We will be in touch with you shortly.

                    Best Regards,

                    Your Company
            Body;

        $email = (new \Symfony\Component\Mime\Email())
            ->from('noreply@example.com')
            ->to($emailAddress)
            ->subject('Welcome!')  // 'Assunto'
            ->attach('Hello World!', 'welcome.txt')  // Attachments (optional)
            ->text($text)
            ->html($html);

        // The template:
        // $dsn = 'smtp://user:pass@smtp.example.com:25';

        // Using the docker container address:
        // $dsn = 'smtp://mailhog:1025';

        // $transporter = Transport::fromDsn($_ENV['MAILER_DSN']);  // This will create a transporter object (SMTP, or whatever transporter you wish to use, like SendGrid, Amazon SES, Mailgun, etc...).

        // $mailer = new Mailer($transporter);

        // $mailer->send($email);

        // $this->emailService->send();

        $this->mailer->send($email);
    }
}
