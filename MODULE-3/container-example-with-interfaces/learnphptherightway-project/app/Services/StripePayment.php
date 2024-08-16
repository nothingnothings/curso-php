<?php


namespace App\Services;

use App\Interfaces\PaymentGatewayServiceInterface;

class StripePayment implements PaymentGatewayServiceInterface
{
    public function charge(array $customer, float $amount, float $tax): bool
    {
        return true;
    }
}