<?php declare(strict_types=1);

namespace App\Middleware;

use App\Services\RequestService;
use App\Config;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\RateLimiter\RateLimiterFactory;

/** This middleware will be used to rate limit requests; in other words, users/ips will have a limit of how many requests they can make in a given time period. */

// ! THIS IS THE VERSION WITHOUT THE SYMFONY RATELIMITER PACKAGE:
// class RateLimitMiddleware implements MiddlewareInterface
// {
//     public function __construct(private readonly CacheInterface $cache,
//                                 private readonly ResponseFactoryInterface $responseFactory,
//                                 private readonly RequestService $requestService,
//                                 private readonly Config $config) {}

//     public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): \Psr\Http\Message\ResponseInterface
//     {
//         // * 1) Obtain IP address:
//         // $clientIp = $request->getServerParams()['REMOTE_ADDR'];
//         $clientIp = $this->requestService->getClientIp($request, $this->config->get('trusted_proxies'));

//         $cacheKey = 'rate_limit' . $clientIp;  // One key for each address, with the COUNT of requests made, as a value.

//         // * 1.5) Check if the key exists in the cache, if it does, get the previous count value:
//         $requests = (int) $this->cache->get($cacheKey);

//         // ! 2 THIS IS THE RATE LIMITER - If the count is greater than 3, in a single minute, return a empty response,  with status 429.
//         if ($requests > 3) {
//             return $this->responseFactory->createResponse(429, 'Too many requests');
//         }

//         // * 3) Store the current count of requests made, using 'cacheKey' as the key. The value will be the amount of requests made, incremented by the latest one:
//         $this->cache->set($cacheKey, $requests + 1, 60);

//         return $handler->handle($request);
//     }
// }

// * This is the version with the Symfony RateLimiter package:
class RateLimitMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly CacheInterface $cache, 
                                private readonly ResponseFactoryInterface $responseFactory,
                                private readonly RequestService $requestService,
                                private readonly Config $config,
                                private readonly RateLimiterFactory $rateLimiterFactory
                                ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): \Psr\Http\Message\ResponseInterface
    {
        // * 1) Obtain IP address:
        // $clientIp = $request->getServerParams()['REMOTE_ADDR'];
        $clientIp = $this->requestService->getClientIp($request, $this->config->get('trusted_proxies'));

        $limiter = $this->rateLimiterFactory->create($clientIp);

        // ! 2) THIS IS THE USAGE OF THE SYMFONY RATE LIMITER - If the count is greater than 3, in a single minute, return a empty response,  with status 429.
        if ($limiter->consume()->isAccepted() === false) {
            return $this->responseFactory->createResponse(429, 'Too many requests');
        }

        // * 3) Store the current count of requests made, using 'cacheKey' as the key. The value will be the amount of requests made, incremented by the latest one:
        $this->cache->set($cacheKey, $requests + 1, 60);


        return $handler->handle($request);
    }
}
