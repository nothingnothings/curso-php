<?php declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Contracts\EmailValidationInterface;

class CurlController
{
    public function __construct(private EmailValidationInterface $emailValidationService) {}

    #[Get('/curl')]
    public function index()
    {
        $email = 'example@example.com';
        $result = $this->emailValidationService->verify($email);

        // Instead of getting these keys from an array, with magic keys, we use the properties of the DTO, which are much safer and better.
        $score = $result->score;
        $isDeliverable = $result->is_deliverable;

        echo '<pre>';
        print_r($score, $isDeliverable);
        echo '</pre>';
    }
}
