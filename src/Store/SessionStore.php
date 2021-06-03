<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Contract\StoreInterface;

/**
 * Class SessionStore
 * This class provides a layer to persist data using PHP Sessions.
 *
 * NOTE: If you are using this storage method for the transient_store option in the Auth0 class along with a
 * response_mode of form_post, the session cookie MUST be set to SameSite=None and Secure using
 * session_set_cookie_params() or another method. This combination will be enforced by browsers in early 2020.
 */
final class SessionStore implements StoreInterface
{
    /**
     * Session base name, configurable on instantiation.
     */
    private ?string $sessionBaseName = null;

    /**
     * SessionStore constructor.
     *
     * @param string $baseName Session base name.
     */
    public function __construct(
        string $baseName = 'auth0'
    ) {
        $this->sessionBaseName = $baseName;
    }

    /**
     * Persists $value on $_SESSION, identified by $key.
     *
     * @param string $key   Session key to set.
     * @param mixed  $value Value to use.
     */
    public function set(
        string $key,
        $value
    ): void {
        $this->initSession();
        $key_name = $this->getSessionKeyName($key);

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
    public function get(
        string $key,
        $default = null
    ) {
        $this->initSession();
        $key_name = $this->getSessionKeyName($key);

        if (isset($_SESSION[$key_name])) {
            return $_SESSION[$key_name];
        }

        return $default;
    }

    /**
     * Removes a persisted value identified by $key.
     *
     * @param string $key Session key to delete.
     */
    public function delete(
        string $key
    ): void {
        $this->initSession();
        unset($_SESSION[$this->getSessionKeyName($key)]);
    }

    /**
     * Constructs a session key name.
     *
     * @param string $key Session key name to prefix and return.
     */
    public function getSessionKeyName(
        string $key
    ): string {
        $key_name = $key;

        if ($this->sessionBaseName !== null) {
            $key_name = $this->sessionBaseName . '_' . $key_name;
        }

        return $key_name;
    }

    /**
     * This basic implementation of BaseAuth0 SDK uses PHP Sessions to store volatile data.
     */
    private function initSession(): void
    {
        $sessionId = session_id();

        if ($sessionId === '' || $sessionId === false) {
            session_start();
        }
    }
}
