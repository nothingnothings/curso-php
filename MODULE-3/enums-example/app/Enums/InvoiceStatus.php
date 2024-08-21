<?php declare(strict_types=1);

namespace App\Enums;

// * Without enums:
// class InvoiceStatus
// {
//     public const PENDING = 0;
//     public const PAID = 1;
//     public const VOID = 2;
//     public const FAILED = 3;

//     public static function all(): array
//     {
//         return [
//             self::PAID,
//             self::FAILED,
//             self::PAID,
//             self::VOID,
//         ];
//     }
// }

// * With enums (pure enum, no default values on cases):
// enum InvoiceStatus
// {
//     case Pending; // Each case of the InvoiceStatus enum is an object of the InvoiceStatus enum
//     case Paid;
//     case Void;
//     case Failed;
// }

// * With enums (BACKED ENUM, with default values assigned on cases) - we can also implement interfaces on our enums.... but inheritance is impossible:
enum InvoiceStatus: int implements SomeInterface
{
    case Pending = 0; // Each case of the InvoiceStatus enum is an object of the InvoiceStatus enum
    case Paid = 1;
    case Void = 2;
    case Failed = 3 ;


    public function convertToString(): string
    {
        return match ($this) {
            self::Paid=>"Paid",
            self::Void => "Void",
            self::Failed => "Declined",
            default => 'Pending'
        };
    }

    // public function color(): string 
    // {
    //     return match($this) {
    //         self::Paid => 'green',
    //         self::Void => 'red',
    //         self::Failed => 'orange',
    //         default => 'gray'
    //     };
    // }
    
    public function color(): Color
    {
        // Enums being returned by a Enum method
        return match($this) {
            self::Paid => Color::Green, 
            self::Void => Color::Red,
            self::Failed => Color::Orange,
            default => Color::Gray
        };
    }

    // Gives us a InvoiceStatus object/case, from a color object/case (passed as a parameter):
    public static function fromColor(Color $color): InvoiceStatus
    {
        return match ($color) {
            Color::Green => self::Paid, 
            Color::Gray => self::Void,
            Color::Red => self::Failed,
            default => self::Pending

        };
    }

    
}