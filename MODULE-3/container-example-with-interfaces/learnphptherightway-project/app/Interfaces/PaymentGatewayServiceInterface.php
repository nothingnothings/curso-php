<?php


namespace App\Interfaces;

interface PaymentGatewayServiceInterface
{
    public function charge(array $customer, float $amount, float $tax): bool;
}