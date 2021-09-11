<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Utility\Toolkit;

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
     * @param SdkConfiguration $configuration Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     * @param string           $sessionPrefix A string to prefix session keys with.
     */
    public function __construct(
        SdkConfiguration $configuration,
        string $sessionPrefix = 'auth0'
    ) {
        [$sessionPrefix] = Toolkit::filter([$sessionPrefix])->string()->trim();

        Toolkit::assert([
            [$sessionPrefix, \Auth0\SDK\Exception\ArgumentException::missing('sessionPrefix')],
        ])->isString();

        $this->configuration = $configuration;
        $this->sessionPrefix = $sessionPrefix ?? 'auth0';

        $this->start();
    }

    /**
     * This has no effect when using sessions as the storage medium.
     *
     * @param bool $deferring Whether to defer persisting the storage state.
     *
     * @codeCoverageIgnore
     *
     * @phpstan-ignore-next-line
     */
    public function defer(
        bool $deferring
    ): void {
        return;
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
        $keyName = $this->getSessionName($key);

        if (isset($_SESSION[$keyName])) {
            return $_SESSION[$keyName];
        }

        return $default;
    }

    /**
     * Removes all persisted values.
     */
    public function purge(): void
    {
        $session = $_SESSION;
        $prefix = $this->sessionPrefix . '_';

        while (current($session)) {
            $sessionKey = key($session);

            if (is_string($sessionKey) && mb_substr($sessionKey, 0, strlen($prefix)) === $prefix) {
                unset($_SESSION[$sessionKey]);
            }

            next($session);
        }
    }

    /**
     * Removes a persisted value identified by $key.
     *
     * @param string $key Session key to delete.
     */
    public function delete(
        string $key
    ): void {
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
        [$key] = Toolkit::filter([$key])->string()->trim();

        Toolkit::assert([
            [$key, \Auth0\SDK\Exception\ArgumentException::missing('key')],
        ])->isString();

        return $this->sessionPrefix . '_' . ($key ?? '');
    }

    /**
     * This basic implementation of BaseAuth0 SDK uses PHP Sessions to store volatile data.
     */
    private function start(): void
    {
        $sessionId = session_id();

        if ($sessionId === '' || $sessionId === false) {
            // @codeCoverageIgnoreStart
            if (! defined('AUTH0_TESTS_DIR')) {
                session_set_cookie_params([
                    'lifetime' => $this->configuration->getCookieExpires(),
                    'domain' => $this->configuration->getCookieDomain(),
                    'path' => $this->configuration->getCookiePath(),
                    'secure' => $this->configuration->getCookieSecure(),
                    'httponly' => true,
                    'samesite' => $this->configuration->getResponseMode() === 'form_post' ? 'None' : 'Lax',
                ]);
            }
            // @codeCoverageIgnoreEnd

            session_register_shutdown();

            session_start();
        }
    }
}
