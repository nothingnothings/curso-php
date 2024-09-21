<?php

declare(strict_types=1);

namespace App;

use DateTime;
use Psr\SimpleCache\CacheInterface;

class RedisCache implements CacheInterface
{

    public function __construct(private readonly \Redis $redis) {}

    public function get(string $key, mixed $default = null): mixed
    {
        $value = $this->redis->get($key);

        // If the value doesn't exist (really false), return the default value (null). Otherwise, return the value assigned to the key. If the value that was stored is bool(false), then an empty string will be returned, due to php casting.
        return $value === false ? $default : $value;
    }

    public function set(string $key, mixed $value, \DateInterval|int|null $ttl = null): bool
    {
        if ($ttl instanceof \DateInterval) {
            $ttl = (new DateTime('@0'))->add($ttl)->getTimestamp();
        }

        return $this->redis->set($key, $value, $ttl);
    }

    public function delete(string $key): bool
    {
        return $this->redis->del($key) === 1;
    }

    public function clear(): bool
    {
        return $this->redis->flushDB();
    }

    public function getMultiple() {}

    public function setMultiple() {}

    public function deleteMultiple() {}

    public function has() {}
}
