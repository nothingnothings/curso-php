<?php 


declare(strict_types=1);

namespace PHP_8_1_Examples\Enum;

// ! Without enums:
// class PaymentStatus
// {
//     public const PAID = 1;
//     public const VOID = 2;
//     public const DECLINED = 3;
// }

// With enums (we use 'case', instead of 'const'):
enum PaymentStatus: int {
    case PAID = 1;
    case VOID = 2;
    case DECLINED = 3;

    // Custom method example:
    public function text(): string 
    {
        return match($this) {
            self::PAID => 'Paid',
            self::VOID => 'Void',
            self::DECLINED => 'Declined'
        };
    }
}
