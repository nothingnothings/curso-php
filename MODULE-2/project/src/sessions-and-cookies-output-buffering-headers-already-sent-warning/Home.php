<?php

declare(strict_types=1);


namespace App19\Classes;


// class Home {

//     public function index() {
//         // From the 'GET and POST superglobals' lesson: 
//         var_dump($_GET); // We can use  this to get the QUERY_STRING, and other parameters
//         var_dump($_POST); // We can use  this to get the POST data, in the body.
//         var_dump($_REQUEST); // Contains both GET and POST data + Data from cookies ($_COOKIE)
//         // return 'Home';


//         return '<form action="/?foo=bar" method="post"><label for="amount">Amount:</label><input type="number" name="amount" id="amount" value="100"><input type="submit"></form>';
//     }
// }




class Home
{

    public function index()
    {


        $_SESSION['count'] = ($_SESSION['count'] ?? 0) + 1;

        // * This is used to CREATE and SET a cookie.
        setcookie( // name, value, expirationTime, path, domain, secure, httpOnly 
            'userName', // name
            'John Doe', // value
            time() + 60, // expirationTime (in this case, 1 minute from now)
            '/', // path for which the cookie will be valid
            '', // domain
            false, // secure (cookie will only be sent over HTTPS)
            false
        );


        // ! If you want to DELETE a cookie, simply set the 'expirationTime' to a value in the PAST.
        // setcookie( // name, value, expirationTime, path, domain, secure, httpOnly 
        //     'userName', // name
        //     'John Doe', // value
        //     time() - 60, // expirationTime (in this case, 1 minute from now)
        //     '/', // path for which the cookie will be valid
        //     '', // domain
        //     false, // secure (cookie will only be sent over HTTPS)
        //     false
        // );

        return View::make('index', $_GET)->render();

        // '<form action="/?foo=bar" method="post"><label for="amount">Amount:</label><input type="number" name="amount" id="amount" value="100"><input type="submit"></form>';
    }
}