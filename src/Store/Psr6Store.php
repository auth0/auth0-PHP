<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Contract\StoreInterface;
use Psr\Cache\CacheItemPoolInterface;

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
     * The storage key to store data under.
     */
    private string $storageKey;

    /**
     * An instance of StoreInterface to use for 'public' storage.
     */
    private StoreInterface $publicStore;

    /**
     * An instance of CacheItemPoolInterface to use for 'private' storage.
     */
    private CacheItemPoolInterface $privateStore;

    /**
     * Psr6Store constructor.
     *
     * @param StoreInterface         $publicStore  An instance of StoreInterface to use for 'public' storage.
     * @param CacheItemPoolInterface $privateStore An instance of CacheItemPoolInterface to use for 'private' storage.
     * @param string                 $storageKey   A string representing the key/namespace under which to store values.
     */
    public function __construct(
        StoreInterface $publicStore,
        CacheItemPoolInterface $privateStore,
        string $storageKey = 'storage_key'
    ) {
        $this->publicStore = $publicStore;
        $this->privateStore = $privateStore;
        $this->storageKey = $storageKey;
    }

    /**
     * Persists $value on $_SESSION, identified by $key.
     *
     * @param string $key   Session key to set.
     * @param mixed  $value Value to use.
     */
    public function set(
        string $key,
        $value
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
     * Gets persisted values identified by $key.
     * If the value is not set, returns $default.
     *
     * @param string $key     Session key to set.
     * @param mixed  $default Default to return if nothing was found.
     *
     * @return mixed
     */
    public function get(
        string $key,
        $default = null
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
     * Removes a value identified by $key.
     *
     * @param string $key Session key to delete.
     */
    public function delete(
        string $key
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
     * Removes all values.
     */
    public function purge(): void
    {
        $this->privateStore->deleteItem($this->getCacheKey());
        $this->publicStore->delete($this->storageKey);
    }

    /**
     * This has no effect when using PSR-6 as the storage medium.
     *
     * @param bool $deferring Whether to defer persisting the storage state.
     *
     * @codeCoverageIgnore
     *
     * @phpstan-ignore-next-line
     */
    public function defer(
        bool $deferring
    ): void {
        return;
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
        } catch (\Exception $exception) {
            $randomBytes = (string) openssl_random_pseudo_bytes(32);
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
