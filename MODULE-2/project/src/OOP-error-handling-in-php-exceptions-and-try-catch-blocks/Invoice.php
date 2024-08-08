<?php




namespace App16;

class Invoice
{

    public function __construct(public Customer $customer)
    {

    }

    public function process(float $amount): void
    {

        // If amount is equal or less than zero, throw an exception
        // if ($amount <= 0) {
        //      throw new \Exception('Invalid invoice amount'); // This is the BASE exception class
        //     throw new \InvalidArgumentException("Invalid invoice amount: $amount"); // This is a exception class that extends the base class.
        // }


        // if (empty($this->customer->getBillingInfo())) {
        //      throw new \InvalidArgumentException("Missing billing information"); // * This is not suited for this specific use-case, so we create a new exception class.
        //     throw new MissingBillingInfoException(); // * This is our custom exception class.
        // }


        if ($amount <= 0) {
            throw InvoiceException::invalidAmount();
        }


        if (empty($this->customer->getBillingInfo())) {
            throw InvoiceException::missingBillingInfo();
        }

        echo 'Processing $' . $amount . ' invoice - ';

        sleep(1);

        echo 'OK ' . PHP_EOL;
    }
}