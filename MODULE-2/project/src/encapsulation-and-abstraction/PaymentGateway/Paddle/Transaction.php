<?php

declare(strict_types=1);


namespace App\PaymentGateway\Paddle;


class Transaction
{
    private float $amount;


    public function __construct(float $amount)
    {

        $this->amount = $amount;
    }


    public function process()
    {
        echo 'Processing $' . $this->amount . ' transaction';

        // This way, we can protect the methods from being called directly
        $this->generateReceipt();
        $this->sendEmail();
    }

    // Private method examples
    private function generateReceipt(): void
    {
        echo 'Receipt generated';
    }

    private function sendEmail(): void
    {
        echo 'Email sent';
    }


    // GETTER EXAMPLE (only add it in your class if you really need it)
    // public function getAmount(): float
    // {
    //     return $this->amount;
    // }

    // SETTER EXAMPLE (we should avoid using methods like this, but it's just an example)
    // public function setAmount(): void
    // {
    //     $this->amount = 100;
    // }

}