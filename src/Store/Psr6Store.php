<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Contract\StoreInterface;
use Exception;
use Psr\Cache\CacheItemPoolInterface;

use function array_key_exists;
use function is_array;
use function is_string;

/**
 * The PSR-6 store needs a PSR-6 CacheItemPool and a public StoreInterface (e.g. CookieStore).
 * The public store is used to store the cache key and the private PSR-6 store is
 * for the actual user data.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class Psr6Store implements StoreInterface
{
    /**
     * Psr6Store constructor.
     *
     * @param StoreInterface         $publicStore  an instance of StoreInterface to use for 'public' storage
     * @param CacheItemPoolInterface $privateStore an instance of CacheItemPoolInterface to use for 'private' storage
     * @param string                 $storageKey   a string representing the key/namespace under which to store values
     */
    public function __construct(
        private StoreInterface $publicStore,
        private CacheItemPoolInterface $privateStore,
        private string $storageKey = 'storage_key',
    ) {
    }

    /**
     * This has no effect when using PSR-6 as the storage medium.
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
     * Removes a value identified by $key.
     *
     * @param string $key session key to delete
     */
    public function delete(
        string $key,
    ): void {
        $item = $this->privateStore->getItem($this->getCacheKey());
        $data = $item->get();

        if (! is_array($data)) {
            $data = [];
        }

        unset($data[$key]);
        $item->set($data);
        $this->privateStore->saveDeferred($item);
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
        $item = $this->privateStore->getItem($this->getCacheKey());
        $data = $item->get();

        if (! is_array($data)) {
            $data = [];
        }

        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return $default;
    }

    /**
     * Removes all values.
     */
    public function purge(): void
    {
        $this->privateStore->deleteItem($this->getCacheKey());
        $this->publicStore->delete($this->storageKey);
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
        $item = $this->privateStore->getItem($this->getCacheKey());
        $data = $item->get();

        if (! is_array($data)) {
            $data = [];
        }

        $data[$key] = $value;
        $item->set($data);
        $this->privateStore->saveDeferred($item);
    }

    /**
     * Generate a cryptographically-secure random string.
     *
     * @codeCoverageIgnore
     */
    private function generateKey(): string
    {
        try {
            $randomBytes = random_bytes(32);
        } catch (Exception) {
            $randomBytes = openssl_random_pseudo_bytes(32);
        }

        return bin2hex($randomBytes);
    }

    /**
     * Generate a cryptographically-secure random string.
     *
     * @codeCoverageIgnore
     */
    private function getCacheKey(): string
    {
        $key = $this->publicStore->get($this->storageKey);

        if (! is_string($key)) {
            $key = $this->generateKey();
            $this->publicStore->set($this->storageKey, $key);
        }

        return 'auth0_' . $key;
    }
}
