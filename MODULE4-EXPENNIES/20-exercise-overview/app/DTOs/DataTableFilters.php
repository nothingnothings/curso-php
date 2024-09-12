<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Entity\Category;
use App\Entity\User;

class DataTableFilters
{
    public function __construct(
        public readonly ?string $searchTerm,
        public readonly ?string $orderBy,
        public readonly ?string $orderDir,
        public readonly ?int $start,
        public readonly ?int $length,
        public readonly ?int $draw,
    ) {}
}
