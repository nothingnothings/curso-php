<?php

declare(strict_types=1);


namespace App30\Controllers;

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




class HomeController
{

    public function index()
    {

        var_dump($_ENV['DB_HOST']);

        $email = 'john.doe@example.com';
        $name = 'John Doe';
        $amount = 25;

        // try {

        // This only works because of the __call magic method, in the DB class.
        // $db = \App30\App::db();

        // $db->beginTransaction();

        // Model usage example:
        $userModel = new \App30\Models\User();
        $invoiceModel = new \App30\Models\Invoice();

        $invoiceId = (new \App30\Models\SignUp($userModel, $invoiceModel))->register(
            [
                'email' => $email,
                'name' => $name
            ],

            [
                'amount' => $amount,
            ]
        );


        // $userId = $userModel->create($email, $name, true);
        // $invoiceId = $invoiceModel->create($amount, $userId);

        // $newUserStmt = $db->prepare('INSERT INTO users (email, full_name, is_active, created_at) VALUES (?, ?, 1, NOW())');

        // $newInvoiceStmt = $db->prepare('INSERT INTO invoices (amount, user_id) VALUES (?, ?)');

        // $newUserStmt->execute([$email, $name]);

        // $userId = (int) $db->lastInsertId();

        // $newInvoiceStmt->execute([$amount, $userId]);

        // $db->commit();


        // } catch (\Throwable $e) {
        //     if ($db->inTransaction()) {
        //         $db->rollBack();
        //         throw new \PDOException($e->getMessage(), (int) $e->getCode());
        //     }
        //     throw $e;
        // }

        // $fetchStmt = $db->prepare(`
        // SELECT invoices.id AS invoice_id, amount, user_id, full_name 
        // FROM invoices 
        // INNER JOIN users 
        // ON user_id = users.id 
        // WHERE email = ?`);

        // $fetchStmt->execute([$email]);

        return \App30\View::make('index', [
            'invoice' => $invoiceModel->find($invoiceId), // use the data from the invoice model.
        ]);
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