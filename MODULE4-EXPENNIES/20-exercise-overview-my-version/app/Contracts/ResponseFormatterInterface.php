<?php declare(strict_types=1);

namespace App\Contracts;

use Psr\Http\Message\ResponseInterface;

interface ResponseFormatterInterface
{
    public function asJson(ResponseInterface $response, array $data): ResponseInterface;
}
