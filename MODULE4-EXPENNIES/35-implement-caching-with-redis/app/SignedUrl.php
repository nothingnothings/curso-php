<?php declare(strict_types=1);

namespace App;

use DateTime;
use Slim\Interfaces\RouteParserInterface;

class SignedUrl
{

    public function __construct(
        private readonly Config $config,
        private readonly RouteParserInterface $routeParser
    ) {

    }
    public function fromRoute(string $routeName, array $routeParams, DateTime $expirationDate): string
    {
        // activationLink format: {BASE_URL}/verify/{USER_ID}/{EMAIL_HASH}?expiration={EXPIRATION_TIMESTAMP}&signature={SIGNATURE}
        $expirationTimestamp = $expirationDate->getTimestamp();
        $queryParams = ['expiration' => $expirationTimestamp];
        $baseUrl = trim($this->config->get('app_url'), '/');

        // {BASE_URL}/verify/{USER_ID}/{EMAIL_HASH}?expiration={EXPIRATION_TIMESTAMP} - THIS WILL BE USED TO GENERATE THE SIGNATURE.
        $url = $baseUrl . $this->routeParser->urlFor($routeName, $routeParams, $queryParams);

        // Arguments: 1) hashing algorithm, 2) url, 3) secret key.
        $signature = hash_hmac('sha256', $url, $this->config->get('app_key'));

        // / {BASE_URL}/verify/{USER_ID}/{EMAIL_HASH}?expiration={EXPIRATION_TIMESTAMP}&signature={SIGNATURE}
        $activationLink = $baseUrl . $this->routeParser->urlFor($routeName, $routeParams, $queryParams) . '&signature=' . $signature;

        return $activationLink;
    }
}
