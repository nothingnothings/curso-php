<?php



namespace App16;

class Customer
{
    public function __construct(private array $billingInfo = [])
    {

    }

    /**
     * getBillingInfo is the GETTER
     * @return array
     */
    public function getBillingInfo(): array
    {
        return $this->billingInfo;
    }
}
