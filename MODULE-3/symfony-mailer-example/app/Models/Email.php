<?php declare(strict_types=1);

namespace App\Models;

use Symfony\Component\Mailer\Mailer;

class Email
{
    public function __construct(protected Mailer $mailer, protected \Symfony\Component\Mime\Email $email) {}

    public function send(\Symfony\Component\Mime\Email $emailMessage): void
    {
        // * The template:
        // $dsn = 'smtp://user:pass@smtp.example.com:25';

        $this->mailer->send($emailMessage);
    }
}
