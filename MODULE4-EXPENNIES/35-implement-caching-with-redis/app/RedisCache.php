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

    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {

        $values = $this->redis->mGet((array) $keys);
        $result = [];

        foreach ($values as $key => $value) {
            $result[$keys[$key]] = $value === false ? $default : $value;
        }

        return $result;
    }

    public function setMultiple(iterable $values, \DateInterval|int|null $ttl = null): bool
    {

        $values = (array) $values;
        $result = $this->redis->mSet($values); // mSet is a method that allows you to set multiple keys at once.


        if ($ttl !== null) {
            if ($ttl instanceof \DateInterval) {
                $ttl = (new DateTime('@0'))->add($ttl)->getTimestamp();
            }

            foreach (array_keys($values) as $key) {
                $this->redis->expire($key, (int) $ttl);
            }
        }

        return $result;
    }

    public function deleteMultiple(iterable $keys): bool
    {
        $keys = (array) $keys;

        return $this->redis->del($keys) === count($keys);
    }

    public function has(string $key): bool
    {
        return $this->redis->exists($key);
    }
}
