<?php declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;

class CurlController
{
    #[Get('/curl')]
    public function index()
    {
        // returns a cURL handle object, without url assigned
        $handle = curl_init();

        // assigns the URL to the handle (along with other options, if you want)
        // curl_setopt($handle, CURLOPT_URL, 'https://www.google.com/');

        // curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);  // This will make it so that the output (HTML) is returned as a string, instead of being printed directly to the browser

        // This fires the actual request;
        // curl_exec($handle);

        // * Same as code seen above, but with a single method call:
        // curl_setopt_array($handle, [
        //     CURLOPT_URL => 'https://www.google.com/',
        //     CURLOPT_RETURNTRANSFER => true,
        // ]);

        $apiKey = $_ENV['EMAILABLE_API_KEY'];
        $email = 'programwithgio@gmail.com';
        $url = 'https://api.emailable.com/v1/verify?email=' . $email . '&api_key=' . $apiKey;

        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($handle);  // this will store the HTML in a variable

        var_dump($content);  // this will print out the HTML content

        // echo '<pre>';
        // print_r(curl_getinfo($handle));  // this will print out the info about the request (headers, status code, etc)
        // echo '</pre>';

        // Close the handle to free up resources //! (This is not really needed, after php8)
        // curl_close($handle);

        // if ($error = curl_error($handle)) {  // curl_error() returns the last error message, if an error occurred
        //     // do something
        // }

        if ($content !== false) {
            $data = json_decode($content, true);

            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }
    }
}
