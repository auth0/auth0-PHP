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

    /**
     * Cookie expiration, configurable on instantiation.
     *
     * @var integer
     */
    protected $cookie_expiration;

    /**
     * CookieStore constructor.
     *
     * @param string  $base_name Cookie base name.
     * @param integer $expires   Cookie expiration length, in seconds.
     */
    public function __construct(?string $base_name = self::BASE_NAME, ?int $expires = 600)
    {
        $this->cookie_base_name  = $base_name;
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
        $this->setCookie( $key_name, $value );
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
        $this->setCookie( $key_name );
    }

    /**
     * Set or delete a cookie.
     *
     * @param string      $key_name Cookie name to set.
     * @param string|null $value    Cookie value; set to null to delete the cookie.
     *
     * @return boolean
     */
    protected function setCookie(string $key_name, ?string $value = null) : bool
    {
        if (is_null($value)) {
            return setcookie($key_name);
        }

        return setcookie($key_name, $value, time() + $this->cookie_expiration, '/', '', false, true);
    }

    /**
     * Constructs a cookie name.
     *
     * @param string $key Cookie name to prefix and return.
     *
     * @return string
     */
    protected function getCookieName(string $key) : string
    {
        $key_name = $key;
        if (! empty( $this->cookie_base_name )) {
            $key_name = $this->cookie_base_name.'_'.$key_name;
        }

        return $key_name;
    }
}
