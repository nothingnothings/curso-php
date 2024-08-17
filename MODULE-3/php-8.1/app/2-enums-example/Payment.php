<?php declare(strict_types=1);

namespace PHP_8_1_Examples\Enum;

class Payment
{
    // * Without enums:
    // private int $status;

    // * With enums:
    private PaymentStatus $status;

    // * Example without enum usage ($status can only be typed as a scalar value, like 'int')
    // public function updateStatus(int $status): Payment
    // {
    //     $this->status = $status;

    //     return $this;
    // }

    // * Example with enum usage ($status can be typed as an enum, like 'PaymentStatus')
    public function updateStatus(PaymentStatus $status): Payment
    {
        $this->status = $status;

        return $this;
    }

    public function status(): PaymentStatus
    {
        return $this->status;
    }
}
