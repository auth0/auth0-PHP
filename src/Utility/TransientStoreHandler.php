<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Auth0\SDK\Contract\StoreInterface;

/**
 * Class TransientStoreHandler
 */
final class TransientStoreHandler
{
    /**
     * Storage method to use.
     */
    private StoreInterface $store;

    /**
     * TransientStoreHandler constructor.
     *
     * @param StoreInterface $store Storage method to use.
     */
    public function __construct(
        StoreInterface $store
    ) {
        $this->store = $store;
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
     * @param bool $deferring Whether to defer persisting the storage state.
     *
     * @codeCoverageIgnore
     */
    public function defer(
        bool $deferring
    ): void {
        $this->getStore()->defer($deferring);
    }

    /**
     * Store a value for a specific key.
     *
     * @param string $key   Key to use.
     * @param string $value Value to store.
     */
    public function store(
        string $key,
        string $value
    ): void {
        $this->store->set($key, $value);
    }

    /**
     * Generate and store a random nonce value for a key.
     *
     * @param string $key Key to use.
     */
    public function issue(
        string $key
    ): string {
        $nonce = $this->getNonce();
        $this->store($key, $nonce);
        return $nonce;
    }

    /**
     * Check if a key has a stored value or not.
     *
     * @param string $key Key to check.
     */
    public function isset(
        string $key
    ): bool {
        return ! is_null($this->store->get($key));
    }

    /**
     * Delete a stored value from storage.
     *
     * @param string $key Key to get and delete.
     */
    public function delete(
        string $key
    ): void {
        $this->store->delete($key);
    }

    /**
     * Get a value and delete it from storage.
     *
     * @param string $key Key to get and delete.
     */
    public function getOnce(
        string $key
    ): ?string {
        $value = $this->store->get($key, null);
        $this->store->delete($key);
        return $value !== null ? (string) $value : null;
    }

    /**
     * Get a value once and check that it matches an existing value.
     *
     * @param string $key      Key to get once.
     * @param string $expected Value expected.
     */
    public function verify(
        string $key,
        string $expected
    ): bool {
        return $this->getOnce($key) === $expected;
    }

    /**
     * Generate a random nonce value.
     *
     * @param int $length Length of the generated value, in bytes.
     *
     * @codeCoverageIgnore
     */
    private function getNonce(
        int $length = 16
    ): string {
        try {
            $randomBytes = random_bytes($length);
        } catch (\Exception $exception) {
            $randomBytes = (string) openssl_random_pseudo_bytes($length);
        }

        return bin2hex($randomBytes);
    }
}
