<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\RequestServiceInterface;
use App\Contracts\SessionInterface;
use App\DTOs\DataTableFilters;
use Psr\Http\Message\ServerRequestInterface;

class RequestService implements RequestServiceInterface
{
    public function __construct(private readonly ServerRequestInterface $request, private readonly SessionInterface $session) {}

    public function getReferer($request): string
    {
        $referer = $this->request->getHeader('referer')[0] ?? '';

        if (!$referer) {
            return $this->session->get('previousUrl');
        }

        $refererHost = parse_url($referer, PHP_URL_HOST);

        if ($refererHost !== $request->getUri()->getHost()) {
            $referer = $this->session->get('previousUrl');
        }

        return $referer;
    }

    public function isXhr(ServerRequestInterface $request): bool
    {
        return $request->getHeaderLine('X-Requested-With') === 'XMLHttpRequest';
    }

    public function getDataTableQueryParameters(ServerRequestInterface $request): DataTableFilters
    {
        $params = $request->getQueryParams();

        $start = (int) $params['start'];
        $length = (int) $params['length'];
        $orderBy = $params['columns'][$params['order'][0]['column']]['data'];
        $orderDirection = $params['order'][0]['dir'];
        $searchTerm = $params['search']['value'];
        $draw = (int) $params['draw'];

        return new DataTableFilters($searchTerm, $orderBy, $orderDirection, $start, $length, $draw);
    }
}
