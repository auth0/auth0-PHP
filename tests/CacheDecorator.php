<?php

namespace Auth0\tests;

use Psr\SimpleCache\CacheInterface;

class CacheDecorator implements CacheInterface
{
    private $cache;
    private $counter = [];

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function get($key, $default = null)
    {
        $this->add_count('get');

        return $this->cache->get($key, $default);
    }

    public function set($key, $value, $ttl = null)
    {
        $this->add_count('set');

        return $this->cache->set($key, $value, $ttl);
    }

    public function delete($key)
    {
        $this->add_count('delete');

        return $this->cache->delete($key);
    }

    public function clear()
    {
        $this->add_count('clear');

        return $this->cache->clear();
    }

    public function getMultiple($keys, $default = null)
    {
        $this->add_count('getMultiple');

        return $this->cache->getMultiple($keys, $default);
    }

    public function setMultiple($values, $ttl = null)
    {
        $this->add_count('setMultiple');

        return $this->cache->setMultiple($values, $ttl);
    }

    public function deleteMultiple($keys)
    {
        $this->add_count('deleteMultiple');

        return $this->cache->deleteMultiple($keys);
    }

    public function has($key)
    {
        $this->add_count('has');

        return $this->cache->has($key);
    }

    private function add_count($method)
    {
        if (!isset($this->counter[$method])) {
            $this->counter[$method] = 0;
        }
        ++$this->counter[$method];
    }

    public function count($method)
    {
        if (!isset($this->counter[$method])) {
            return null;
        }

        return $this->counter[$method];
    }
}
