<?php 

declare(strict_types= 1);


namespace App20\Exceptions;


class RouteNotFoundException extends \Exception {

    protected $message = '404 Not Found';
}

