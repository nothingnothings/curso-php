<?php

declare(strict_types=1);


namespace App\PaymentGateway\Paddle;


class Transaction
{

    public static int $count = 0; // * Static property example

    private static int $count2 = 10; // * Static property example (but private, to showcase how static methods work)



    public function __construct(
        public float $amount,
        public string $description
    ) {
        self::$count++; // * We increment the static property 'count' on each object that gets created.
    }


    public function process()
    {
        echo 'Processing paddle transaction...';
    }


    public static function getCount2(): int
    {
        // echo $this; // This won't work, because the 'self' keyword is used to access the current object, and that is not allowed in static methods.
        return self::$count2; // This will work, because the 'self' keyword is used to access the current class, and that is allowed in static methods.
    }

}

