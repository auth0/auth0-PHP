<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Utility\Toolkit;

use function defined;

/**
 * This class provides a layer to persist data using PHP Sessions.
 */
final class SessionStore implements StoreInterface
{
    /**
     * SessionStore constructor.
     *
     * @param SdkConfiguration $configuration Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     * @param string           $sessionPrefix a string to prefix session keys with
     */
    public function __construct(
        private SdkConfiguration $configuration,
        private string $sessionPrefix = 'auth0',
    ) {
    }

    /**
     * This has no effect when using sessions as the storage medium.
     *
     * @param bool $deferring whether to defer persisting the storage state
     *
     * @codeCoverageIgnore
     */
    public function defer(
        bool $deferring,
    ): void {
    }

    /**
     * Removes a persisted value identified by $key.
     *
     * @param string $key session key to delete
     */
    public function delete(
        string $key,
    ): void {
        $this->start();

        unset($_SESSION[$this->getSessionName($key)]);
    }

    /**
     * Gets persisted values identified by $key.
     * If the value is not set, returns $default.
     *
     * @param string $key     session key to set
     * @param mixed  $default default to return if nothing was found
     *
     * @return mixed
     */
    public function get(
        string $key,
        $default = null,
    ) {
        $this->start();

        $keyName = $this->getSessionName($key);

        if (isset($_SESSION[$keyName])) {
            return $_SESSION[$keyName];
        }

        return $default;
    }

    /**
     * Constructs a session key name.
     *
     * @param string $key session key name to prefix and return
     */
    public function getSessionName(
        string $key,
    ): string {
        [$key] = Toolkit::filter([$key])->string()->trim();

        Toolkit::assert([
            [$key, \Auth0\SDK\Exception\ArgumentException::missing('key')],
        ])->isString();

        return $this->sessionPrefix . '_' . ($key ?? '');
    }

    /**
     * Removes all persisted values.
     */
    public function purge(): void
    {
        $this->start();

        $session = $_SESSION ?? [];
        $prefix = $this->sessionPrefix . '_';

        if ([] !== $session) {
            while ($sessionKey = key($session)) {
                if (mb_substr($sessionKey, 0, mb_strlen($prefix)) === $prefix) {
                    unset($_SESSION[$sessionKey]);
                }

                next($session);
            }
        }
    }

    /**
     * Persists $value on $_SESSION, identified by $key.
     *
     * @param string $key   session key to set
     * @param mixed  $value value to use
     */
    public function set(
        string $key,
        $value,
    ): void {
        $this->start();

        $_SESSION[$this->getSessionName($key)] = $value;
    }

    /**
     * This basic implementation of BaseAuth0 SDK uses PHP Sessions to store volatile data.
     */
    public function start(): void
    {
        $sessionId = session_id();

        if ('' === $sessionId || false === $sessionId) {
            // @codeCoverageIgnoreStart
            if (! defined('AUTH0_TESTS_DIR')) {
                session_set_cookie_params([
                    'lifetime' => $this->configuration->getCookieExpires(),
                    'domain' => $this->configuration->getCookieDomain(),
                    'path' => $this->configuration->getCookiePath(),
                    'secure' => $this->configuration->getCookieSecure(),
                    'httponly' => true,
                    'samesite' => 'form_post' === $this->configuration->getResponseMode() ? 'None' : $this->configuration->getCookieSameSite() ?? 'Lax',
                ]);
            }
            // @codeCoverageIgnoreEnd

            session_register_shutdown();

            session_start();
        }
    }
}
