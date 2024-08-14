<?php


declare(strict_types=1);


namespace Tests\Unit\Services;

use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;
use PHPUnit\Framework\TestCase;

// TODO - This is an example of how to create MOCKS
class InvoiceServiceTest extends TestCase
{


    /** @test */
    public function it_processes_invoice(): void
    {
        // TODO - These are MOCKS:
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class); // Mock objects' methods will return 'null', by default.
        $gatewayServiceMock = $this->createMock(PaymentGatewayService::class);
        $emailServiceMock = $this->createMock(EmailService::class);

        // TODO -This is a STUB (it normally returns false, but we make it return true, for the test):
        $gatewayServiceMock->method('charge')->willReturn(true);

        var_dump($salesTaxServiceMock->calculate(100, [])); // will return float(0)

        // data for the invoice
        $customer = ['name' => 'Gio'];
        $amount = 300;

        // * Given that we have an invoice service object
        $invoiceService = new InvoiceService($salesTaxServiceMock, $gatewayServiceMock, $emailServiceMock);

        // *  When process() is called
        $result = $invoiceService->process($customer, $amount);

        // * Then assert that the invoice is processed successfully.
        $this->assertTrue($result);
    }


    /** @test */
    public function it_sends_receipt_email_when_invoice_is_processed(): void
    {
        // TODO - These are MOCKS:
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class); // Mock objects' methods will return 'null', by default.
        $gatewayServiceMock = $this->createMock(PaymentGatewayService::class);
        $emailServiceMock = $this->createMock(EmailService::class);

        // TODO -This is a STUB (it normally returns false, but we make it return true, for the test):
        $gatewayServiceMock->method('charge')->willReturn(true);

        $emailServiceMock
            ->expects($this->once())
            ->method('send')
            ->with(['name' => 'Gio'], 'receipt');

        // * Given that we have an invoice service object
        $invoiceService = new InvoiceService(
            $salesTaxServiceMock,
            $gatewayServiceMock,
            $emailServiceMock
        );

        // data for the invoice
        $customer = ['name' => 'Gio'];
        $amount = 300;

        // * When process() is called
        $result = $invoiceService->process($customer, $amount);

        // * Then assert invoice is processed successfully.
        $this->assertTrue($result);
    }
}
