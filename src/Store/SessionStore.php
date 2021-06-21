<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Utility\Validate;

/**
 * Class SessionStore
 * This class provides a layer to persist data using PHP Sessions.
 */
final class SessionStore implements StoreInterface
{
    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private SdkConfiguration $configuration;

    /**
     * Session base name, configurable on instantiation.
     */
    private string $sessionPrefix;

    /**
     * SessionStore constructor.
     *
     * @param SdkConfiguration $configuration   Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     * @param string           $sessionPrefix   Optional. A string to prefix session keys with.
     */
    public function __construct(
        SdkConfiguration &$configuration,
        string $sessionPrefix = 'auth0'
    ) {
        Validate::string($sessionPrefix, 'sessionPrefix');

        $this->configuration = & $configuration;
        $this->sessionPrefix = trim($sessionPrefix);

        $this->start();
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
        Validate::string($key, 'key');

        $_SESSION[$this->getSessionName($key)] = $value;
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
        Validate::string($key, 'key');

        $keyName = $this->getSessionName($key);

        if (isset($_SESSION[$keyName])) {
            return $_SESSION[$keyName];
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
        Validate::string($key, 'key');

        unset($_SESSION[$this->getSessionName($key)]);
    }

    /**
     * Constructs a session key name.
     *
     * @param string $key Session key name to prefix and return.
     */
    public function getSessionName(
        string $key
    ): string {
        return $this->sessionPrefix . '_' . trim($key);
    }

    /**
     * This basic implementation of BaseAuth0 SDK uses PHP Sessions to store volatile data.
     */
    private function start(): void
    {
        $sessionId = session_id();

        if ($sessionId === '' || $sessionId === false) {
            session_set_cookie_params([
                'lifetime' => $this->configuration->getCookieExpires(),
                'domain' => $this->configuration->getCookieDomain(),
                'path' => $this->configuration->getCookiePath(),
                'secure' => $this->configuration->getCookieSecure(),
                'httponly' => true,
                'samesite' => $this->configuration->getResponseMode() === 'form_post' ? 'None' : 'Lax',
            ]);

            session_register_shutdown();

            session_start();
        }
    }
}
