<?php

namespace App16;


// Custom Exception, created by us. Needs to extend the base Exception class to be throwable.
class MissingBillingInfoException extends \Exception
{
    // Custom exception message
    protected $message = "Missing billing information"; // this will be set as the exception message

}