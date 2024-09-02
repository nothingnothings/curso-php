<?php declare(strict_types=1);

namespace App\DTO;

// This is a DTO example. All of its properties should be readonly, as they should never be altered after it is created.
class EmailValidationResult
{
    public function __construct(
        public readonly int $score,
        public readonly bool $is_deliverable
    ) {}
}
