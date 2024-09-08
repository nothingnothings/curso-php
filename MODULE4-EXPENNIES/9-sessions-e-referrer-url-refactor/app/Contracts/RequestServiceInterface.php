<?php declare(strict_types=1);

namespace App\Contracts;

interface RequestServiceInterface
{
    public function getReferer(Request $request): string;
}
