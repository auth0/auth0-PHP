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
    private const PUBLIC_STORAGE_KEY = 'storage_key';
    private StoreInterface $publicStore;
    private CacheItemPoolInterface $privateStore;

    public function __construct(
        StoreInterface $publicStore,
        CacheItemPoolInterface $privateStore
    ) {
        $this->publicStore = $publicStore;
        $this->privateStore = $privateStore;
    }

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

    public function get(
        string $key,
        ?string $default = null
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

    public function deleteAll(): void
    {
        $this->privateStore->deleteItem($this->getCacheKey());
        $this->publicStore->delete(self::PUBLIC_STORAGE_KEY);
    }

    private function generateKey(): string
    {
        try {
            $randomBytes = random_bytes(32);
        } catch (\Exception $exception) {
            $randomBytes = (string) openssl_random_pseudo_bytes(32);
        }

        return bin2hex($randomBytes);
    }

    private function getCacheKey(): string
    {
        $key = $this->publicStore->get(self::PUBLIC_STORAGE_KEY);
        if (! is_string($key)) {
            $key = $this->generateKey();
            $this->publicStore->set(self::PUBLIC_STORAGE_KEY, $key);
        }

        return 'auth0_'.$key;
    }
}
