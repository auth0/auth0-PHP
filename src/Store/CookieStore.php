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
    const BASE_NAME = 'auth0_';

    /**
     * Cookie base name.
     * Use config key 'base_name' to set this during instantiation.
     *
     * @var string
     */
    protected $baseName;

    /**
     * Cookie expiration length.
     * This will be added to current time or $this->now to set cookie expiration time.
     * Use config key 'expiration' to set this during instantiation.
     *
     * @var integer
     */
    protected $expiration;

    /**
     * SameSite attribute for all cookies set with class instance.
     * Must be one of None, Strict, Lax (default is no SameSite attribute).
     * Use config key 'samesite' to set this during instantiation.
     *
     * @var null|string
     */
    protected $sameSite;

    /**
     * Time to use as "now" in expiration calculations.
     * Used primarily for testing.
     * Use config key 'now' to set this during instantiation.
     *
     * @var null|integer
     */
    protected $now;

    /**
     * Support legacy browsers for SameSite=None.
     * This will set/get/delete a fallback cookie with no SameSite attribute if $this->sameSite is None.
     * Use config key 'legacy_samesite_none' to set this during instantiation.
     *
     * @var boolean
     */
    protected $legacySameSiteNone;

    /**
     * CookieStore constructor.
     *
     * @param array $options Cookie options. See class properties above for keys and types allowed.
     */
    public function __construct(array $options = [])
    {
        $this->baseName   = $options['base_name'] ?? self::BASE_NAME;
        $this->expiration = $options['expiration'] ?? 600;

        if (! empty($options['samesite']) && is_string($options['samesite'])) {
            $sameSite = ucfirst($options['samesite']);

            if (in_array($sameSite, ['None', 'Strict', 'Lax'])) {
                $this->sameSite = $sameSite;
            }
        }

        $this->now = $options['now'] ?? null;

        $this->legacySameSiteNone = $options['legacy_samesite_none'] ?? true;
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

        if ($this->sameSite) {
            $this->setCookieHeader($key_name, $value, $this->getExpTimecode());
        } else {
            $this->setCookie($key_name, $value, $this->getExpTimecode());
        }

        if ($this->legacySameSiteNone && 'None' === $this->sameSite) {
            $_COOKIE['_'.$key_name] = $value;
            $this->setCookie('_'.$key_name, $value, $this->getExpTimecode());
        }
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
        $value    = $default;

        // If we're handling legacy browsers, check for fallback value first.
        if ($this->legacySameSiteNone) {
            $value = $_COOKIE['_'.$key_name] ?? $value;
        }

        return $_COOKIE[$key_name] ?? $value;
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
        $this->setCookie( $key_name, '', 0 );

        if ($this->legacySameSiteNone) {
            unset($_COOKIE['_'.$key_name]);
            $this->setCookie( '_'.$key_name, '', 0 );
        }
    }

    /**
     * Build the header to use when setting SameSite cookies.
     * Core setcookie() function does not handle SameSite before PHP 7.3.
     *
     * @param string  $name   Cookie name.
     * @param string  $value  Cookie value.
     * @param integer $expire Cookie expiration timecode.
     *
     * @return string
     */
    public function getSameSiteCookieHeader(string $name, string $value, int $expire) : string
    {
        $date = new \Datetime();
        $date->setTimestamp($expire)
            ->setTimezone(new \DateTimeZone('GMT'));

        return sprintf(
            'Set-Cookie: %s=%s; path=/; expires=%s; HttpOnly; SameSite=%s%s',
            $name,
            $value,
            $date->format($date::COOKIE),
            $this->sameSite,
            'None' === $this->sameSite ? '; Secure' : ''
        );
    }

    /**
     * Get cookie expiration timecode to use.
     *
     * @return integer
     */
    private function getExpTimecode() : int
    {
        return ($this->now ?? time()) + $this->expiration;
    }

    /**
     * Wrapper around PHP core setcookie() function to assist with testing.
     *
     * @param string  $name   Complete cookie name to set.
     * @param string  $value  Value of the cookie to set.
     * @param integer $expire Expiration time in Unix timecode format.
     *
     * @return boolean
     *
     * @codeCoverageIgnore
     */
    protected function setCookie(string $name, string $value, int $expire) : bool
    {
        return setcookie($name, $value, $expire, '/', '', false, true);
    }

    /**
     * Wrapper around PHP core header() function to assist with testing.
     *
     * @param string  $name   Complete cookie name to set.
     * @param string  $value  Value of the cookie to set.
     * @param integer $expire Expiration time in Unix timecode format.
     *
     * @return void
     *
     * @codeCoverageIgnore
     */
    protected function setCookieHeader(string $name, string $value, int $expire) : void
    {
        header($this->getSameSiteCookieHeader($name, $value, $expire), false);
    }

    /**
     * Constructs a cookie name.
     *
     * @param string $key Cookie name to prefix and return.
     *
     * @return string
     */
    public function getCookieName(string $key) : string
    {
        $key_name = $key;
        if (! empty( $this->baseName )) {
            $key_name = $this->baseName.'_'.$key_name;
        }

        return $key_name;
    }
}
