<?php

namespace Auth0\SDK\Store;

/**
 * This class provides a layer to persist user access using PHP Sessions.
 *
 * @author Auth0
 */
class SessionStore implements StoreInterface
{
    /**
     * Session base name, if not configured.
     */
    const BASE_NAME = 'auth0_';

    /**
     * Session base name, configurable on instantiation.
     *
     * @var string
     */
    protected $session_base_name = self::BASE_NAME;

    /**
     * Session cookie expiration, configurable on instantiation.
     *
     * @var integer
     */
    protected $session_cookie_expires;

    /**
     * SessionStore constructor.
     *
     * @param string|null $base_name      Session base name.
     * @param integer     $cookie_expires Session expiration in seconds; default is 1 week.
     */
    public function __construct($base_name = null, $cookie_expires = 604800)
    {
        if (! empty( $base_name )) {
            $this->session_base_name = $base_name;
        }

        $this->session_cookie_expires = (int) $cookie_expires;
    }

    /**
     * This basic implementation of BaseAuth0 SDK uses
     * PHP Sessions to store volatile data.
     *
     * @return void
     */
    private function initSession()
    {
        if (! session_id()) {
            if (! empty( $this->session_cookie_expires )) {
                session_set_cookie_params($this->session_cookie_expires);
            }

            session_start();
        }
    }

    /**
     * Persists $value on $_SESSION, identified by $key.
     *
     * @param string $key   Session key to set.
     * @param mixed  $value Value to use.
     *
     * @return void
     */
    public function set($key, $value)
    {
        $this->initSession();
        $key_name            = $this->getSessionKeyName($key);
        $_SESSION[$key_name] = $value;
    }

    /**
     * Gets persisted values identified by $key.
     * If the value is not set, returns $default.
     *
     * @param string $key     Session key to set.
     * @param mixed  $default Default to return if nothing was found.
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $this->initSession();
        $key_name = $this->getSessionKeyName($key);

        if (isset($_SESSION[$key_name])) {
            return $_SESSION[$key_name];
        } else {
            return $default;
        }
    }

    /**
     * Removes a persisted value identified by $key.
     *
     * @param string $key Session key to delete.
     *
     * @return void
     */
    public function delete($key)
    {
        $this->initSession();
        $key_name = $this->getSessionKeyName($key);
        unset($_SESSION[$key_name]);
    }

    /**
     * Constructs a session key name.
     *
     * @param string $key Session key name to prefix and return.
     *
     * @return string
     */
    public function getSessionKeyName($key)
    {
        return $this->session_base_name.'_'.$key;
    }
}
