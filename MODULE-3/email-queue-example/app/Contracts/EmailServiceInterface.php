<?php declare(strict_types=1);

namespace App\Contracts;

interface EmailServiceInterface
{
    public function sendQueuedEmails(string $to, string $subject, string $body): void;
}
