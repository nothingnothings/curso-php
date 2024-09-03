<?php declare(strict_types=1);

namespace App\Services;

namespace App\Services\AbstractAPI;

use App\Contracts\EmailValidationInterface;
use App\DTO\EmailValidationResult;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class EmailValidationService implements EmailValidationInterface
{
    private string $baseUrl = 'https://emailvalidation.abstractapi.com/v1';

    public function __construct(private string $apiKey) {}

    public function verify(string $email): EmailValidationResult
    {
        // * Used to define custom retry logic, on only some status codes (249, 429 and 503)
        $stack = HandlerStack::create();

        $maxRetry = 3;

        $stack->push($this->getRetryMiddleware($maxRetry));
        // $handle = curl_init(); // Replaced by Guzzle http client

        $client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 5,
            'handler' => $stack,
        ]);

        $params = [
            'api_key' => $this->apiKey,
            'email' => $email,
        ];

        $response = $client->get('', ['query' => $params]);

        if ($response !== false) {
            $formattedResponse = json_decode($response->getBody()->getContents(), true);  // getBody() returns a StreamInterface... and getContents() returns the actual contents of the stream as a string.

            return new EmailValidationResult($formattedResponse['quality_score'], $formattedResponse['is_deliverable']);
        }
    }

    private function getRetryMiddleware(int $maxRetry): callable
    {
        return Middleware::retry(
            function (
                int $retries,
                RequestInterface $request,
                ?ResponseInterface $response = null,
                ?\RuntimeException $e = null
            ) use ($maxRetry) {
                if ($retries >= $maxRetry) {
                    return false;
                }

                if ($response && in_array($response->getStatusCode(), [249, 429, 503])) {
                    echo 'Retrying [' . $retries . '], Status: ' . $response->getStatusCode() . PHP_EOL;

                    return true;
                }

                if ($e instanceof ConnectException) {
                    echo 'Retrying [' . $retries . '], Connection Error<br />';

                    return true;
                }

                return false;
            }
        );
    }
}
