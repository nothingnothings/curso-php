<?php declare(strict_types=1);

namespace App\Commands;

use App\Services\InvoiceService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:your-command')]
class YourCommand extends Command
{
    protected static $defaultName = 'app:your-command';
    protected static $defaultDescription = "Your command's description";

    public function __construct(private readonly InvoiceService $invoiceService)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->write('Hello World', true);

        $output->write('Paid Invoices:' . count($this->invoiceService->getPaidInvoices()), true);

        return Command::SUCCESS;
    }
}
