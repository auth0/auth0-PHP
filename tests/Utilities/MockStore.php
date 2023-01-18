<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Auth0\SDK\Contract\StoreInterface;

class MockStore implements StoreInterface
{
    public array $data = [];

    public function get(
        string $key,
        $default = null
    ) {
        return $this->data[$key] ?? $default;
    }

    public function set(
        string $key,
        $value
    ): void {
        $this->data[$key] = $value;
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
        bool $deferring = false
    ): void
    {
    }
}
