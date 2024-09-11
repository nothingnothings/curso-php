<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\RequestServiceInterface;
use App\Contracts\SessionInterface;
use Psr\Http\Message\ServerRequestInterface;

class RequestService implements RequestServiceInterface
{
    public function __construct(private readonly ServerRequestInterface $request, private readonly SessionInterface $session) {}

    public function getReferer($request): string
    {
        $referer = $this->request->getHeader('referer')[0] ?? '';

        if(!$referer) {
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

}