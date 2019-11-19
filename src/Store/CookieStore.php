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
     * Cookie base name, configurable on instantiation.
     *
     * @var string
     */
    protected $baseName;

    /**
     * Cookie expiration, configurable on instantiation.
     *
     * @var integer
     */
    protected $expiration;

    /**
     * SameSite attribute for all cookies.
     *
     * @var integer
     */
    protected $sameSite;

    /**
     * Time to use as "now" in expiration calculations.
     * Useful for testing.
     *
     * @var null|integer
     */
    protected $now;

    /**
     * Support legacy browsers for SameSite=None
     *
     * @var boolean
     */
    protected $legacySameSiteNone;

    /**
     * CookieStore constructor.
     *
     * @param array $options Set cookie options.
     */
    public function __construct(array $options = [])
    {
        $this->baseName   = $options['base_name'] ?? self::BASE_NAME;
        $this->expiration = $options['expiration'] ?? 600;

        $sameSite = 'Lax';
        if (isset($options['samesite']) && is_string($options['samesite'])) {
            $sameSite = ucfirst($options['samesite']);
        }

        if (in_array($sameSite, ['None', 'Strict', 'Lax'])) {
            $this->sameSite = $sameSite;
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
        $this->setCookie($key_name, $value);
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
     * @param $name
     * @param $value
     * @param $handleSameSite
     *
     * @return string
     */
    public function getSetCookieHeader(string $name, string $value, $handleSameSite = true) : string
    {
        $date = new \Datetime();
        $date->setTimestamp($this->getExpTimecode());
        $date->setTimezone(new \DateTimeZone('GMT'));

        $header = sprintf(
            '%s=%s; path=/; expires=%s; HttpOnly',
            $name,
            $value,
            $date->format(\DateTime::COOKIE)
        );

        if ($handleSameSite) {
            $header .= '; SameSite=' . $this->sameSite;
            $header .= 'None' === $this->sameSite ? '; Secure' : '';
        }

        return $header;
    }

    /**
     * @return integer
     */
    private function getExpTimecode() : int
    {
        return ($this->now ?? time()) + $this->expiration;
    }

    /**
     * Set or delete a cookie.
     *
     * @param string $name  Cookie name to set.
     * @param string $value Cookie value.
     *
     * @return boolean
     */
    protected function setCookie(string $name, string $value = '') : bool
    {
        if (! $this->sameSite) {
            return setcookie($name, $value, $this->getExpTimecode(), '/', '', false, true);
        }

        header('Set-Cookie: '.$this->getSetCookieHeader($name, $value), false);

        if ($this->legacySameSiteNone && 'None' === $this->sameSite) {
            header('Set-Cookie: _'.$this->getSetCookieHeader($name, $value, false), false);
        }

        return true;
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
