<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\CategoryData;
use App\DTOs\UserData;

interface RequestValidatorInterface
{
    public function validate(UserData | CategoryData $data): array;
}
