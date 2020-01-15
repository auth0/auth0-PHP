<?php
declare(strict_types=1);

namespace Auth0\SDK\Store;

/**
 * Class SessionStore
 * This class provides a layer to persist data using PHP Sessions.
 *
 * NOTE: If you are using this storage method for the transient_store option in the Auth0 class along with a
 * response_mode of form_post, the session cookie MUST be set to SameSite=None and Secure using
 * session_set_cookie_params() or another method. This combination will be enforced by browsers in early 2020.
 *
 * @package Auth0\SDK\Store
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
    protected $session_base_name;

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
    private function initSession() : void
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
    public function set(string $key, $value) : void
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
    public function get(string $key, $default = null)
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
    public function delete(string $key) : void
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
    public function getSessionKeyName(string $key) : string
    {
        $key_name = $key;
        if (! empty( $this->session_base_name )) {
            $key_name = $this->session_base_name.'_'.$key_name;
        }

        return $key_name;
    }
}
