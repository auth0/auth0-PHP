<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Contract\StoreInterface;

/**
 * In memory storage. This is useful only in tests. Do not use this in production.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class InMemoryStorage implements StoreInterface
{
    /**
     * @var array<string, mixed>
     */
    private array $data = [];

    public function set(
        string $key,
        $value
    ): void {
        $this->data[$key] = $value;
    }

    public function get(
        string $key,
        $default = null
    ) {
        if (\array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return $default;
    }

    public function delete(
        string $key
    ): void {
        unset($this->data[$key]);
    }

    public function purge(): void
    {
        $this->data = [];
    }

    public function defer(
        bool $deferring = true
    ): void {
    }
}
