<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Event\Psr14Store\{Boot, Clear, Defer, Delete, Destruct, Get, Set};

/**
 * This class allows host applications to build custom session storage methods through PSR-14 event hooks.
 */
final class Psr14Store implements StoreInterface
{
    /**
     * Track if a bootup event has been sent out yet.
     */
    private bool $booted = false;

    /**
     * Psr14Store constructor.
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
     * Dispatch event to notify that the class is being destructed.
     */
    public function __destruct()
    {
        $this->configuration->eventDispatcher()->dispatch(new Destruct($this));
    }

    /**
     * Dispatch event to toggle state deferrance.
     *
     * @param bool $deferring whether to defer persisting the storage state
     */
    public function defer(
        bool $deferring,
    ): void {
        $this->boot();
        $this->configuration->eventDispatcher()->dispatch(new Defer($this, $deferring));
    }

    /**
     * Dispatch event to delete key-value pair.
     *
     * @param string $key session key to delete
     */
    public function delete(
        string $key,
    ): void {
        $this->boot();
        $this->configuration->eventDispatcher()->dispatch(new Delete($this, $key));
    }

    /**
     * Dispatch event to retrieve the value of a key-value pair.
     *
     * @param string $key     session key to query
     * @param mixed  $default default to return if nothing was found
     *
     * @return mixed
     */
    public function get(
        string $key,
        $default = null,
    ) {
        $this->boot();

        /**
         * @var Get $event
         */
        $event = $this->configuration->eventDispatcher()->dispatch(new Get($this, $key));
        $value = $event->getValue();

        if (null === $value) {
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
     * Dispatch event to set the value of a key-value pair.
     *
     * @param string $key   session key to set
     * @param mixed  $value value to use
     */
    public function set(
        string $key,
        $value,
    ): void {
        $this->boot();
        $this->configuration->eventDispatcher()->dispatch(new Set($this, $key, $value));
    }

    /**
     * Dispatch event to alert that a session should be prepared for an incoming request.
     */
    private function boot(): void
    {
        if (! $this->booted) {
            $event = $this->configuration->eventDispatcher()->dispatch(new Boot($this, $this->sessionPrefix));

            /** @var Boot $event */
            $this->sessionPrefix = $event->getPrefix();
            $this->booted = true;
        }
    }
}
