<?php declare(strict_types=1);

namespace App\Services;

use App\Enums\EmailStatus;
use App\Models\Email;
use Symfony\Component\Mailer\MailerInterface;

class EmailService
{
    public function __construct(protected Email $emailModel, protected MailerInterface $mailer) {}

    public function sendQueuedEmails(): void
    {
        // Get emails that weren't sent yet:
        $emails = $this->emailModel->getEmailsByStatus(EmailStatus::Queue);

        foreach ($emails as $email) {
            var_dump($email);

            $meta = json_decode($email->META, true);

            $emailMessage = (new \Symfony\Component\Mime\Email())
                ->from($meta['from'])
                ->to($meta['to'])
                ->subject($email->SUBJECT)
                ->html($email->HTML_BODY)
                ->text($email->TEXT_BODY);

            $this->mailer->send($emailMessage);

            $this->emailModel->markEmailSent($email->id);
        }
    }
}
