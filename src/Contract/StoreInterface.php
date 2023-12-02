<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract;

interface StoreInterface
{
    /**
     * Defer saving state changes to destination to improve performance during blocks of changes.
     *
     * @param bool $deferring
     */
    public function defer(
        bool $deferring,
    ): void;

    /**
     * Remove a value from the store.
     *
     * @param string $key key to delete
     */
    public function delete(
        string $key,
    ): void;

    /**
     * Get a value from the store by a given key.
     *
     * @param string $key     key to get
     * @param mixed  $default return value if key not found
     *
     * @return mixed
     */
    public function get(
        string $key,
        $default = null,
    );

    /**
     * Remove all stored values.
     */
    public function purge(): void;

    /**
     * Set a value on the store.
     *
     * @param string $key   key to set
     * @param mixed  $value value to set
     */
    public function set(
        string $key,
        $value,
    ): void;
}
