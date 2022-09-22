<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Event\Psr14Store\Boot;
use Auth0\SDK\Event\Psr14Store\Clear;
use Auth0\SDK\Event\Psr14Store\Defer;
use Auth0\SDK\Event\Psr14Store\Delete;
use Auth0\SDK\Event\Psr14Store\Destruct;
use Auth0\SDK\Event\Psr14Store\Get;
use Auth0\SDK\Event\Psr14Store\Set;
use Auth0\SDK\Utility\Toolkit;

/**
 * Class Psr14Store
 * This class allows host applications to build custom session storage methods through PSR-14 event hooks.
 */
final class Psr14Store implements StoreInterface
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
     * Track if a bootup event has been sent out yet.
     */
    private bool $booted = false;

    /**
     * Psr14Store constructor.
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
    }

    /**
     * Dispatch event to notify that the class is being destructed.
     */
    public function __destruct()
    {
        $this->configuration->eventDispatcher()->dispatch(new Destruct($this));
    }

    /**
     * Dispatch event to toggle state deferrance.
     *
     * @param bool $deferring Whether to defer persisting the storage state.
     */
    public function defer(
        bool $deferring
    ): void {
        $this->boot();
        $this->configuration->eventDispatcher()->dispatch(new Defer($this, $deferring));
    }

    /**
     * Dispatch event to set the value of a key-value pair.
     *
     * @param string $key   Session key to set.
     * @param mixed  $value Value to use.
     */
    public function set(
        string $key,
        $value
    ): void {
        $this->boot();
        $this->configuration->eventDispatcher()->dispatch(new Set($this, $key, $value));
    }

    /**
     * Dispatch event to retrieve the value of a key-value pair.
     *
     * @param string $key     Session key to query.
     * @param mixed  $default Default to return if nothing was found.
     *
     * @return mixed
     */
    public function get(
        string $key,
        $default = null
    ) {
        $this->boot();

        /**
         * @var Get $event
         */
        $event = $this->configuration->eventDispatcher()->dispatch(new Get($this, $key));
        $value = $event->getValue();

        if ($value === null) {
            return $default;
        }

        return $value;
    }

    /**
     * Dispatch event to clear all key-value pairs.
     */
    public function purge(): void
    {
        $this->boot();
        $this->configuration->eventDispatcher()->dispatch(new Clear($this));
    }

    /**
     * Dispatch event to delete key-value pair.
     *
     * @param string $key Session key to delete.
     */
    public function delete(
        string $key
    ): void {
        $this->boot();
        $this->configuration->eventDispatcher()->dispatch(new Delete($this, $key));
    }

    /**
     * Dispatch event to alert that a session should be prepared for an incoming request.
     */
    private function boot(): void
    {
        if (! $this->booted) {
            $event = $this->configuration->eventDispatcher()->dispatch(new Boot($this, $this->sessionPrefix));

            /**
             * @var Boot $event
             */

            $this->sessionPrefix = $event->getPrefix();
            $this->booted = true;
        }

        return;
    }
}
