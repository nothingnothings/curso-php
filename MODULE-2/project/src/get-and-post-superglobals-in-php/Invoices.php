<?php 

declare(strict_types= 1);


namespace App20\Classes;


class Invoices {

    public function index() {

        return 'Invoices';
    }

    public function create(): string {
        return '<form action="/invoices/create" method="post"><label for="amount">Amount:</label><input type="number" name="amount" id="amount" value="100"><input type="submit"></form>';
    }

    public function store(): void {
        $amount = $_POST['amount'];

        var_dump($amount);
    }
}

