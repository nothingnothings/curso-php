<?php declare(strict_types=1);

namespace App\Services;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;

class EmailService
{
    public function __construct(protected \App\Models\Email $emailModel) {}

    public function send(): void
    {
        // echo 'REACHED';
        // $transporter = Transport::fromDsn($_ENV['MAILER_DSN']);  // This will create a transporter object (SMTP, or whatever transporter you wish to use, like SendGrid, Amazon SES, Mailgun, etc...).
        // $mailer = new Mailer($transporter);
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

        $emailObject = (new \Symfony\Component\Mime\Email())
            ->from('noreply@example.com')
            ->to($emailAddress)
            ->subject('Welcome!')  // 'Assunto'
            ->attach('Hello World!', 'welcome.txt')  // Attachments (optional)
            ->text($text)
            ->html($html);

        $this->emailModel->send($emailObject);
    }
}
