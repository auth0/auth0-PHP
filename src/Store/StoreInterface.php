<?php
namespace Auth0\SDK\Store;

interface StoreInterface
{
    /**
     * Set a value on the store
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value);

    /**
     * Get a value from the store by a given key
     *
     * @param  string     $key
     * @param  mixed|null $default
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Remove a value from the store
     *
     * @param  string $key
     * @return mixed
     */
    public function delete($key);
}
