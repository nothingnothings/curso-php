<?php

declare(strict_types=1);


namespace App\PaymentGateway\Paddle;

use App\Enums\Status;


class Transaction
{
    // Class Constants example (also pseudo 'enums' example, to avoid typos)
    // public const STATUS_PAID = 'paid';
    // public const STATUS_PENDING = 'pending';
    // private const STATUS_DECLINED = 'declined'; // With 'private', the constant can't be accessed from outside the class with the '::' notation 

    // private const ALL_STATUSES = [
    //     self::STATUS_PAID => 'Paid',
    //     self::STATUS_PENDING => 'Pending',
    //     self::STATUS_DECLINED => 'Declined',
    // ];


    private string $status;

    public function __construct()
    {

        // var_dump(Transaction::STATUS_DECLINED); // * This is one of the ways of accessing class constants FROM INSIDE OF THE OWN CLASS WHERE THEY ARE DEFINED. This will output 'declined'
        // var_dump(self::STATUS_DECLINED); // * This is the another way of accessing class constants FROM INSIDE OF THE OWN CLASS WHERE THEY ARE DEFINED. This will output 'declined'


        // $this->setStatus(self::STATUS_PENDING); // using the constants as sort of enums (to avoid typos)...

        $this->setStatus(Status::PAID);

    }


    public function setStatus(string $status): self // 'self' --> this return type is often used to be able to chain methods calls together.
    {
        if (
            // - !isset(self::ALL_STATUSES[$status])

            !isset(Status::ALL_STATUSES[$status])

        ) {
            throw new \Exception('Invalid status');
        } else {
            $this->status = $status;
            return $this;
        }
    }

}