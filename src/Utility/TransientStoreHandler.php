<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Auth0\SDK\Contract\StoreInterface;

/**
 * Class TransientStoreHandler.
 */
final class TransientStoreHandler
{
    /**
     * TransientStoreHandler constructor.
     *
     * @param  StoreInterface  $store  storage method to use
     */
    public function __construct(
        private StoreInterface $store,
    ) {
    }

    /**
     * Return the current storage method.
     */
    public function getStore(): StoreInterface
    {
        return $this->store;
    }

    /**
     * Defer saving state changes to destination to improve performance during blocks of changes.
     *
     * @param  bool  $deferring  whether to defer persisting the storage state
     *
     * @codeCoverageIgnore
     */
    public function defer(
        bool $deferring,
    ): void {
        $this->getStore()->defer($deferring);
    }

    /**
     * Store a value for a specific key.
     *
     * @param  string  $key  key to use
     * @param  string  $value  value to store
     */
    public function store(
        string $key,
        string $value,
    ): void {
        $this->store->set($key, $value);
    }

    /**
     * Generate and store a random nonce value for a key.
     *
     * @param  string  $key  key to use
     */
    public function issue(
        string $key,
    ): string {
        $nonce = $this->getNonce();
        $this->store($key, $nonce);

        return $nonce;
    }

    /**
     * Check if a key has a stored value or not.
     *
     * @param  string  $key  key to check
     */
    public function isset(
        string $key,
    ): bool {
        return null !== $this->store->get($key);
    }

    /**
     * Delete a stored value from storage.
     *
     * @param  string  $key  key to get and delete
     */
    public function delete(
        string $key,
    ): void {
        $this->store->delete($key);
    }

    /**
     * Get a value and delete it from storage.
     *
     * @param  string  $key  key to get and delete
     */
    public function getOnce(
        string $key,
    ): ?string {
        /** @var int|string|null $value */
        $value = $this->store->get($key, null);

        $this->store->delete($key);

        return null !== $value ? (string) $value : null;
    }

    /**
     * Get a value once and check that it matches an existing value.
     *
     * @param  string  $key  key to get once
     * @param  string  $expected  value expected
     */
    public function verify(
        string $key,
        string $expected,
    ): bool {
        return $this->getOnce($key) === $expected;
    }

    /**
     * Generate a random nonce value.
     *
     * @param  int  $length  length of the generated value, in bytes
     *
     * @codeCoverageIgnore
     */
    public function getNonce(
        int $length = 16,
    ): string {
        $length = $length >= 1 ? $length : 1;

        try {
            $randomBytes = random_bytes($length);
        } catch (\Exception $exception) {
            $randomBytes = (string) openssl_random_pseudo_bytes($length);
        }

        return bin2hex($randomBytes);
    }
}
