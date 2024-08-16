<?php


namespace App\Services;

use App\Interfaces\PaymentGatewayServiceInterface;
use App\Services\Interfaces\PaymentInterface;
use App\Services\Interfaces\PaymentResponseInterface;

class PaddlePayment implements PaymentGatewayServiceInterface
{
    public function charge(array $customer, float $amount, float $tax): bool
    {
        return true;
    }
}