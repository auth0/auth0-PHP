<?php

namespace Auth0\SDK\Store;

/**
 * This class is a mockup store, that discards the values, its a way of saying no store.
 */
class EmptyStore implements StoreInterface
{
    public function set($key, $value)
    {
    }

    public function get($key, $default = null)
    {
        return $default;
    }

    public function delete($key)
    {
    }
}
