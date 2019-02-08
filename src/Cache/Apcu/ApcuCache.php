<?php declare (strict_types = 1);

namespace Demo\Cache\Apcu;

use DateInterval;
use DateTime;
use Psr\SimpleCache\CacheInterface;
use Traversable;

final class ApcuCache implements CacheInterface
{
    public function get($key, $default = null)
    {
        if (!is_string($key)) {
            throw InvalidArgumentException::fromString();
        }
        $value = apcu_fetch($key, $success);
        if (!$success) {
            return $default;
        }

        return $value;
    }

    public function set($key, $value, $ttl = null): bool
    {
        if (!is_string($key)) {
            throw InvalidArgumentException::fromString();
        }
        if ($ttl instanceof DateInterval) {
            // Converting to a TTL in seconds
            $ttl = (new DateTime('now'))->add($ttl)->getTimestamp() - time();
        }

        return apcu_store($key, $value, (int) $ttl);
    }

    public function delete($key): bool
    {
        if (!is_string($key)) {
            throw InvalidArgumentException::fromString();
        }

        return apcu_delete($key);
    }

    public function clear(): bool
    {
        return apcu_clear_cache();
    }

    public function getMultiple($keys, $default = null)
    {
        if (!is_array($keys) && !$keys instanceof Traversable) {
            throw InvalidArgumentException::fromTraversable();
        }
        foreach ($keys as $key) {
            yield $key => $this->get($key, $default);
        }
    }

    public function setMultiple($values, $ttl = null): bool
    {
        if (!is_array($values) && !$values instanceof Traversable) {
            throw InvalidArgumentException::fromTraversable();
        }
        $result = true;
        foreach ($values as $key => $value) {
            if (!$this->set($key, $value, $ttl)) {
                $result = false;
            }
        }

        return $result;

    }

    public function deleteMultiple($keys): bool
    {
        if (!is_array($keys) && !$keys instanceof Traversable) {
            throw InvalidArgumentException::fromTraversable();
        }
        $result = true;
        foreach ($keys as $key) {
            if (!$this->delete($key)) {
                $result = false;
            }
        }

        return $result;
    }

    public function has($key): bool
    {
        if (!is_string($key)) {
            throw InvalidArgumentException::fromString();
        }

        return apcu_exists($key);
    }
}
