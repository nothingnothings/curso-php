<?php declare(strict_types=1);

namespace App\Contracts;

use Slim\Psr7\Request;

interface RequestServiceInterface
{
    public function getReferer(Request $request): string;

    public function isXhr(Request $request): bool;
}
