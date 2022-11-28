<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Contract\StoreInterface;

/**
 * In memory storage. This is useful only in tests. Do not use this in production.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class MemoryStore implements StoreInterface
{
    /**
     * @var array<string, mixed>
     */
    private array $data = [];

    /**
     * Store value in memory.
     *
     * @param  string  $key  session key to set
     * @param  mixed  $value  value to use
     */
    public function set(
        string $key,
        $value,
    ): void {
        $this->data[$key] = $value;
    }

    /**
     * Return value from memory.
     * If the value is not set, returns $default.
     *
     * @param  string  $key  session key to set
     * @param  mixed  $default  default to return if nothing was found
     * @return mixed
     */
    public function get(
        string $key,
        $default = null,
    ) {
        if (\array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return $default;
    }

    /**
     * Removes a value identified by $key from memory.
     *
     * @param  string  $key  key of value to remove
     */
    public function delete(
        string $key,
    ): void {
        unset($this->data[$key]);
    }

    /**
     * Removes all stored values from memory.
     */
    public function purge(): void
    {
        $this->data = [];
    }

    /**
     * This has no effect when using memory as a storage medium.
     *
     * @param  bool  $deferring  whether to defer persisting the storage state
     *
     * @codeCoverageIgnore
     */
    public function defer(
        bool $deferring = true,
    ): void {
    }
}
