<?php

declare(strict_types=1);


namespace App21\Controllers;

use App21\View;


class HomeController
{

    public function index(): View
    {


        // return (new \App21\View('index'))->render();

        return View::make('index', ['foo' => 'bar']);
    }


    public function download()
    {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;filename="myfile.pdf"');

        readfile(STORAGE_PATH, '/receipt 6-20-2021.pdf');
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

        // echo '';

        // echo var_dump(pathinfo($filePath));

        header('Location: /'); // * Redirects user to the home page, using this header.

        exit; // We must exit the script execution, otherwise the codes that follow will be executed even after user was redirected.

    }


}