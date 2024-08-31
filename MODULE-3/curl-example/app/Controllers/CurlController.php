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
        curl_setopt($handle, CURLOPT_URL, 'https://www.google.com/');

        // This fires the actual request;
        curl_exec($handle);

        // Close the handle to free up resources //! (This is not really needed, after php8) 
        // curl_close($handle);
    }
}
