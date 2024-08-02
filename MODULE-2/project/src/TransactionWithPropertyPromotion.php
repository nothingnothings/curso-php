<?php


declare(strict_types=1);


// Without the Constructor Property Promotion Shorthand in the constructor:
class TransactionTraditional
{
    private float $amount; // TODO - as seen below, this is not needed, in the shorthand version.
    private string $description;  // TODO  as seen below, this is not needed, in the shorthand version.

    public function __construct(
        float $amount,
        string $description
    ) {

        $this->amount = $amount; // TODO - as seen below, this is not needed, in the shorthand version.
        $this->description = $description; // TODO - as seen below, this is not needed, in the shorthand version.
    }
}
;


// With the Constructor Property Promotion Shorthand in the constructor:
class TransactionShortHand
{
    private ?Customer $customer = null;

    public function __construct(
        private float $amount,
        private string $description
    ) {

    }

    // Getter
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }
}
;