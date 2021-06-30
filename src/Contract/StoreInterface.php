<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract;

/**
 * Interface StoreInterface
 */
interface StoreInterface
{
    /**
     * Set a value on the store
     *
     * @param string $key   Key to set.
     * @param mixed  $value Value to set.
     */
    public function set(
        string $key,
        $value
    ): void;

    /**
     * Get a value from the store by a given key.
     *
     * @param string      $key     Key to get.
     * @param string|null $default Return value if key not found.
     *
     * @return mixed
     */
    public function get(
        string $key,
        ?string $default = null
    );

    /**
     * Remove a value from the store
     *
     * @param string $key Key to delete.
     */
    public function delete(
        string $key
    ): void;

    /**
     * Remove all stored values
     */
    public function deleteAll(): void;
}
