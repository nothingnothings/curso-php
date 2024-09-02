<?php

declare(strict_types=1);

namespace App\Services\Shipping;

class PackageDimensions
{
    public function __construct(
        private readonly int $width,
        private readonly int $height,
        private readonly int $length,
    ) {}
}
