<?php

namespace Auth0\SDK\Store;

use Psr\SimpleCache\CacheInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class SimpleCacheStore implements StoreInterface
{
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @param CacheInterface $cachePool
     */
    public function __construct(CacheInterface $cachePool)
    {
        $this->cache = $cachePool;
    }

    public function set($key, $value)
    {
        return $this->cache->set($this->cleanKey($key), $value);
    }

    public function get($key, $default = null)
    {
        if (null === $result = $this->cache->get($this->cleanKey($key))) {
            return $default;
        }

        return $result;
    }

    public function delete($key)
    {
        $this->cache->delete($this->cleanKey($key));
    }

    private function cleanKey($key)
    {
        return preg_replace('|[^A-Za-z0-9_\.]|', '', $key);
    }
}