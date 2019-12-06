<?php

namespace Auth0\SDK\Helpers\Cache;

/**
 * @deprecated 5.7.0, switching to Psr\SimpleCache\CacheInterface in 7.0.0
 */
interface CacheHandler
{

    /**
     *
     * @param  string $key
     * @return mixed
     */
    public function get($key);

    /**
     *
     * @param string $key
     */
    public function delete($key);

    /**
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value);
}
