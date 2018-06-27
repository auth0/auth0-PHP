<?php

namespace Auth0\SDK\Store;

/*
 * This file is part of Auth0-PHP package.
 *
 * (c) Auth0
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

/**
 * This class provides a layer to persist user access using cookies.
 *
 * @author Auth0
 */
class CookieStore implements StoreInterface
{

    /**
     * Cookie base name
     */
    const BASE_NAME = 'auth0_';

    /**
     * Time from now to expire, 7 days by default
     */
    const COOKIE_EXPIRES = 604800;

    /**
     * CookieStore constructor.
     */
    public function __construct()
    {
    }

    /**
     * Persists $value on $_SESSION, identified by $key.
     *
     * @param string $key   - storage key to set
     * @param mixed  $value - value to set
     */
    public function set($key, $value)
    {
        if (is_array( $value ) || is_object( $value )) {
            $value = serialize( $value );
        }

        $key_name           = $this->getCookieKeyName( $key );
        $_COOKIE[$key_name] = $value;
        setcookie( $key_name, $value, time() + self::COOKIE_EXPIRES, '/' );
    }

    /**
     * Gets persisted values identified by $key.
     * If the value is not set, returns $default.
     *
     * @param string $key     - storage key to get
     * @param mixed  $default - default to return if not found
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $key_name = $this->getCookieKeyName($key);
        return isset( $_COOKIE[$key_name] ) ? $_COOKIE[$key_name] : $default;
    }

    /**
     * Removes a persisted value identified by $key.
     *
     * @param string $key - storage key to delete
     */
    public function delete($key)
    {
        $key_name = $this->getCookieKeyName($key);
        unset( $_COOKIE[$key_name] );
        setcookie( $key_name, '', 0, '/' );
    }

    /**
     * Constructs a session var name.
     *
     * @param string $key
     *
     * @return string
     */
    public function getCookieKeyName($key)
    {
        return self::BASE_NAME.'_'.$key;
    }
}
