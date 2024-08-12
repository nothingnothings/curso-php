<?php

declare(strict_types=1);


namespace App19\Classes;

use App\DB;
use PDO;


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




// class Home
// {

//     public function index()
//     {


//         $_SESSION['count'] = ($_SESSION['count'] ?? 0) + 1;

//         // TODO - COOKIES LESSON:
//         // * This is used to CREATE and SET a cookie.
//         setcookie( // name, value, expirationTime, path, domain, secure, httpOnly 
//             'userName', // name
//             'John Doe', // value
//             time() + 60, // expirationTime (in this case, 1 minute from now)
//             '/', // path for which the cookie will be valid
//             '', // domain
//             false, // secure (cookie will only be sent over HTTPS)
//             false
//         );


//         // ! If you want to DELETE a cookie, simply set the 'expirationTime' to a value in the PAST.
//         // setcookie( // name, value, expirationTime, path, domain, secure, httpOnly 
//         //     'userName', // name
//         //     'John Doe', // value
//         //     time() - 60, // expirationTime (in this case, 1 minute from now)
//         //     '/', // path for which the cookie will be valid
//         //     '', // domain
//         //     false, // secure (cookie will only be sent over HTTPS)
//         //     false
//         // );

//         return View::make('index', $_GET)->render();

//         // '<form action="/?foo=bar" method="post"><label for="amount">Amount:</label><input type="number" name="amount" id="amount" value="100"><input type="submit"></form>';
//     }
// }




class Home
{

    public function index()
    {

        var_dump($_ENV['DB_HOST']);

        // * PDO (php data objects - with my sql) lesson:
        try {
            $db = new PDO(
                'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'], // This is how you use env variables (if you load them with phpdotenv)
                $_ENV['DB_USER'], // username
                $_ENV['DB_PASSWORD'], // password
            );

            $email = 'john.doe@example.com';
            $name = 'John Doe';
            $amount = 25;

        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }


        try {
            $db->beginTransaction(); // This will start a transaction.

            $newUserStmt = $db->prepare('INSERT INTO users (email, full_name, is_active, created_at) VALUES (?, ?, 1, NOW())');

            $newInvoiceStmt = $db->prepare('INSERT INTO invoices (amount, user_id) VALUES (?, ?)');

            $newUserStmt->execute([$email, $name]);

            $userId = (int) $db->lastInsertId();

            $newInvoiceStmt->execute([$amount, $userId]);

            $db->commit(); // This will commit the transaction (apply all changes).
        } catch (\Throwable $e) {
            if ($db->inTransaction()) { // * This will only execute if a transaction is ongoing.
                $db->rollBack(); // *  This will rollback the transaction (undo all changes).
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }

            throw $e; // Throw generic exception.

        }



        $fetchStmt = $db->prepare(`
        SELECT invoices.id AS invoice_id, amount, user_id, full_name 
        FROM invoices 
        INNER JOIN users 
        ON user_id = users.id 
        WHERE email = ?`);

        $fetchStmt->execute([$email]);

    }


    public function upload(): void
    {
        echo '<pre>';
        echo var_dump($_FILES);   // Will dump an array with objects with the keys 'receipt', 'name', 'type', 'tmp_name', 'error', 'size'.
        echo '</pre>';


        var_dump(pathinfo($_FILES['receipt']['tmp_name'])); // get additional information about the file.

        $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];
        // Files that are uploaded with requests get stored temporarily in the 'tmp' folder, and get deleted after the request is finished.
        // That's why we need to move the file to a permanent location, either locally, or to the cloud (s3 storage, for example):

        move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);

        echo '';

        echo var_dump(pathinfo($filePath));

    }


}