<?php


namespace App;


// Most basic example of singleton pattern:
class DB
{
    private static ?DB $instance = null;


    // The constructor is private, so it can only be called from within the class itself. This class cannot be instantiated from the outside with a code like 'new DB()'.
    private function __construct(public array $config)
    {

        echo 'Instance Created<br/>';
    }

    // Gives the singleton instance of the class.
    public static function getInstance(array $config): DB
    {
        if (self::$instance === null) {
            self::$instance = new DB($config);
        }
        return self::$instance;
    }
}