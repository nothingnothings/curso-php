<?php 

namespace App\Enums;

declare(strict_types= 1);

enum Color: string
{
    case Green = 'green';
    case Red = 'red';
    case Orange = 'orange';
    case Gray = 'gray';

    // used in the view:
    public function getClass() 
    {
        return 'color-' . $this->value;
    }
}