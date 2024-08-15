<?php

declare(strict_types=1);

namespace App\Services;
use App\Interfaces\PaymentGatewayServiceInterface;

class PaymentGatewayService implements PaymentGatewayServiceInterface
{
    public function charge(array $customer, float $amount, float $tax): bool
    {
        // sleep(1);

        return (bool) 1;
    }
}
