<?php

declare(strict_types=1);


namespace App19\Classes;

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





        // ! SESSION AND COOKIES LESSON:
        // $_SESSION['count'] = ($_SESSION['count'] ?? 0) + 1;


        // * PDO (php data objects - with my sql) lesson:
        try {
            $db = new PDO(
                'mysql:host=db;dbname=MY_DB', // DSN (data source name) - composed of host (localhost) and database name (MY_DB)
                'root', // username
                // 'rootdassdaa', // ! Testing errors and exception handling.
                'root', // password
                // [ // * Use this if you want to set the default fetch mode to 'object', instead of 'both'.
                //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                // ]
            );



            $email = $_GET["email"];

            $query = 'SELECT * FROM users WHERE email = ?';

            // ? This is using ordered parameters (normal placeholders, like '?'):
            // $insertQuery = 'INSERT INTO users (email, full_name, is_active, created_at) VALUES (?, ?, ?, ?);';

            // ? This is using named parameters (:name placeholders):
            $insertQuery = 'INSERT INTO users (email, full_name, is_active, created_at) VALUES (:email, :full_name, :is_active, :date);';

            // $query = 'SELECT * FROM users';

            // $stmt = $db->query($query); // ! This is not safe - we should use prepared statements, with the 'prepare()' method, to avoid SQL injection.

            // $stmt = $db->prepare($query); // * This is safer - but it won't be enough, you still need to sanitize the data and use placeholders/named parameters.

            $stmt = $db->prepare($insertQuery);

            // ? This is using ordered parameters (normal placeholders, like '?'), and not named parameters.
            // $stmt->execute([$email, 'Arthur', true, date('Y-m-d H:i:s', strtotime('07/11/2021 9:00PM'))]); // this is needed, when using 'prepare()' and placeholders ('?' symbols).

            // ? This is using named parameters (:name placeholders), and not ordered parameters:
            $stmt->execute(['name' => $email, 'full_name' => 'Arthur', 'is_active' => true, 'created_at' => date('Y-m-d H:i:s', strtotime('07/11/2021 9:00PM'))]);


            $id = $db->lastInsertId();

            $user = $db->query('SELECT * FROM users WHERE id = ' . $id);



            // * 'fetchAll' - should be used with SELECT queries, and not insert/update/delete.
            // $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // 'fetchAll' - method that is used to fetch all the results from the query.

            echo '<pre>';
            // print_r($result);
            var_dump($user);
            echo '</pre>';

        } catch (\PDOException $e) {
            // With this, we can hide sensitive database information (like username and password) from the user.
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }


        // phpinfo();

        // return View::make('index', $_GET)->render();


        // File Uploads lesson:
//         return <<<HTML
//         <form action="/upload" method="post" enctype="multipart/form-data">
//             <label for="amount">File:</label>
//             <input type="file" name="receipt">
//             <button type="submit">upload</button>
//         </form>
// HTML;


        // TODO - USE THIS IF YOU WANT TO UPLOAD MULTIPLE FILES:
// return <<<HTML
// <form action="/upload" method="post" enctype="multipart/form-data">
//     <label for="receipt">Receipt:</label>
//     <input type="file" name="receipt[]">
//     <label for="receipt">Receipt:</label>
//     <input type="file" name="receipt[]">
//     <button type="submit">Upload</button>
// </form>
// HTML;
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