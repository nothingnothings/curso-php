<?php declare(strict_types=1);

namespace App\Controllers;

use App\Models\Ticket;
use Generator;

class GeneratorExampleController
{
    public function __construct(private Ticket $ticketModel) {}

    // public function index()
    // {
    //     // $numbers = range(1, 1_000_000); // This will work, but the print will take a while
    //     // $numbers = range(1, 30_000_000);  // This won't work, out of memory error. We need generators.

    //     $numbers = $this->lazyRange(1, 30_000_000);

    //     echo $numbers->current();

    //     $numbers->next();

    //     echo $numbers->current();

    //     echo $numbers->getReturn();

    //     // echo '<pre>';
    //     // print_r($numbers);
    //     // echo '</pre>';
    // }
    //
    public function index()
    {
        $tickets = $this->ticketModel->all();

        // Generator usage
        foreach ($tickets as $ticket) {
            echo $ticket['id'] . ': ' . substr($ticket['content'], 0, 15) . '<br />';
        }
    }

    // public function index()
    // {
    //     $numbers = $this->lazyRange(1, 30_000);

    //     foreach ($numbers as $key => $number) {
    //         echo $key . ': ' . $number . '<br />';
    //     }
    // }

    // same parameters as range(), but works differently (uses generators)
    private function lazyRange(int $start, int $end): Generator
    {
        // ! This is literally the same as range(), and will have memory issues:
        // $numbers = [];
        // for ($i = $start; $i <= $end; $i++) {
        //     $numbers[] = $i;
        // }
        // return $numbers;

        // echo 'Hello!';
        // * This is the actual generator
        for ($i = $start; $i <= $end; $i++) {
            // yield $i * 5;
            yield $i * 5 => $i;
        }
    }
}
