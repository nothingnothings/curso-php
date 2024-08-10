<?php 

declare(strict_types= 1);


namespace App20\Classes;


class Home {

    public function index() {

        var_dump($_GET); // We can use  this to get the QUERY_STRING, and other parameters
        var_dump($_POST); // We can use  this to get the POST data, in the body.
        var_dump($_REQUEST); // Contains both GET and POST data + Data from cookies ($_COOKIE)
        // return 'Home';

        return '<form action="/?foo=bar" method="post"><label for="amount">Amount:</label><input type="number" name="amount" id="amount" value="100"><input type="submit"></form>';

    }
}

