<?php


declare(strict_types=1);


namespace App\Services;

use App\Models\Invoice;

class InvoiceService
{

    public function __construct(
        protected SalesTaxService $salesTaxService,
        protected PaymentGatewayService $paymentGatewayService,
        protected EmailService $emailService
    ) { // Used for mocking (flexibility between real and mock objects)


    }



    public function process(array $customer, float $amount): bool
    {
        // * Instead of hardcoding this directly, we can use dependency injection with our real/mock objects:
        // $salesTaxService = new SalesTaxService(); 
        // $gatewayService = new PaymentGateWayService();
        // $emailService = new EmailService();


        // 1. Calculate sales tax
        // $tax = $salesTaxService->calculate($amount, $customer);
        $tax = $this->salesTaxService->calculate($amount, $customer);


        // 2. Process invoice
        // if (!$gatewayService->charge($customer, $amount, $tax)) {
        if (!$this->paymentGatewayService->charge($customer, $amount, $tax)) {

            return false;
        }

        // 3. Send receipt
        // $emailService->send($customer, 'receipt');
        $this->emailService->send($customer, 'receipt');


        return true;
    }
}