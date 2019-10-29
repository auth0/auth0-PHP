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
     * Default session base name.
     */
    const BASE_NAME = 'auth0_';

    /**
     * Session base name, configurable on instantiation.
     *
     * @var string
     */
    protected $session_base_name = self::BASE_NAME;

    /**
     * SessionStore constructor.
     *
     * @param string $base_name Session base name.
     */
    public function __construct($base_name = self::BASE_NAME)
    {
        $this->session_base_name = (string) $base_name;
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
        $key_name = $key;
        if (! empty( $this->session_base_name )) {
            $key_name = $this->session_base_name.'_'.$key_name;
        }

        return $key_name;
    }
}
