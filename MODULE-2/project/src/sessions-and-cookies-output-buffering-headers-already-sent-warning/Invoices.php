<?php 

declare(strict_types= 1);


namespace App19\Classes;


class Invoices {

    public function index() {

        // var_dump($_SESSION); // Superglobals can be accessed in any place of your code.

        unset($_SESSION['count']); // With this, you can unset any keys in the session of the user.

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

