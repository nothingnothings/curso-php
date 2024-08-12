<?php

declare(strict_types=1);


namespace App30\Exceptions;

class ViewNotFoundException extends \Exception
{
    protected $message = 'View not found';

}