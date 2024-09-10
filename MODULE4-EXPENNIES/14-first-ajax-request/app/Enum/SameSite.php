<?php declare(strict_types=1);

namespace App\Enum;

enum SameSite: string
{
    case Strict = 'Strict';
    case Lax = 'lax';
    case None = 'None';

}