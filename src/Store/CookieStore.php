<?php

namespace Auth0\SDK\Store;

/**
 * This class provides a layer to persist transient auth data using cookies.
 */
class CookieStore implements StoreInterface
{
    /**
     * Default cookie base name.
     */
    const BASE_NAME = 'auth0';

    /**
     * Cookie base name, configurable on instantiation.
     *
     * @var string
     */
    protected $cookie_base_name;
    protected $cookie_expiration;

    /**
     * CookieStore constructor.
     *
     * @param string $base_name Cookie base name.
     * @param int $expires Cookie expiration length, in seconds.
     */
    public function __construct(?string $base_name = self::BASE_NAME, ?int $expires = 600)
    {
        $this->cookie_base_name = $base_name;
        $this->cookie_expiration = $expires;
    }

    /**
     * Persists $value on cookies, identified by $key.
     *
     * @param string $key   Cookie to set.
     * @param mixed  $value Value to use.
     *
     * @return void
     */
    public function set($key, $value)
    {
        $key_name           = $this->getCookieName($key);
        $_COOKIE[$key_name] = $value;
        setcookie($key_name, $value, time() + $this->cookie_expiration, '/', '', false, true);
    }

    /**
     * Gets persisted values identified by $key.
     * If the value is not set, returns $default.
     *
     * @param string $key     Cookie to set.
     * @param mixed  $default Default to return if nothing was found.
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $key_name = $this->getCookieName($key);
        return $_COOKIE[$key_name] ?? $default;
    }

    /**
     * Removes a persisted value identified by $key.
     *
     * @param string $key Cookie to delete.
     *
     * @return void
     */
    public function delete($key)
    {
        $key_name = $this->getCookieName($key);
        unset($_COOKIE[$key_name]);
        setcookie($key_name);
    }

    /**
     * Constructs a cookie name.
     *
     * @param string $key Cookie name to prefix and return.
     *
     * @return string
     */
    public function getCookieName($key)
    {
        $key_name = $key;
        if (! empty( $this->cookie_base_name )) {
            $key_name = $this->cookie_base_name.'_'.$key_name;
        }

        return $key_name;
    }
}
