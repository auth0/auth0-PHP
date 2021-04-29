<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Contract\StoreInterface;

/**
 * Class EmptyStore.
 * Used to fulfill an interface without providing actual storage.
 *
 * @package Auth0\SDK\Store
 */
class EmptyStore implements StoreInterface
{
    /**
     * Do nothing.
     *
     * @param string $key   Key to set.
     * @param mixed  $value Value to set.
     */
    public function set(
        string $key,
        $value
    ): void {
    }

    /**
     * Return the default.
     *
     * @param string      $key     Key to get.
     * @param string|null $default Return value if key not found.
     *
     * @return mixed
     */
    public function get(
        string $key,
        ?string $default = null
    ) {
        return $default;
    }

    /**
     * Do nothing.
     *
     * @param string $key Key to delete.
     */
    public function delete(
        string $key
    ): void {
    }
}
