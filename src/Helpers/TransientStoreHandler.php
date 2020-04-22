<?php
declare(strict_types=1);

namespace Auth0\SDK\Helpers;

use Auth0\SDK\Store\StoreInterface;

/**
 * Class TransientStoreHandler
 *
 * @package Auth0\SDK\Helpers
 */
class TransientStoreHandler
{

    /**
     * Storage method to use.
     *
     * @var StoreInterface
     */
    private $store;

    /**
     * TransientStoreHandler constructor.
     *
     * @param StoreInterface $store Storage method to use.
     */
    public function __construct(StoreInterface $store)
    {
        $this->store = $store;
    }

    /**
     * Store a value for a specific key.
     *
     * @param string $key   Key to use.
     * @param string $value Value to store.
     *
     * @return void
     */
    public function store(string $key, string $value) : void
    {
        $this->store->set($key, $value);
    }

    /**
     * Generate and store a random nonce value for a key.
     *
     * @param string $key Key to use.
     *
     * @return string
     */
    public function issue(string $key) : string
    {
        $nonce = $this->getNonce();
        $this->store($key, $nonce);
        return $nonce;
    }

    /**
     * Check if a key has a stored value or not.
     *
     * @param string $key Key to check.
     *
     * @return boolean
     */
    public function isset(string $key) : bool
    {
        return ! is_null($this->store->get($key));
    }

    /**
     * Get a value and delete it from storage.
     *
     * @param string $key Key to get and delete.
     *
     * @return string|null
     */
    public function getOnce(string $key)
    {
        $value = $this->store->get($key);
        $this->store->delete($key);
        return $value;
    }

    /**
     * Get a value once and check that it matches an existing value.
     *
     * @param string $key      Key to get once.
     * @param string $expected Value expected.
     *
     * @return boolean
     */
    public function verify(string $key, string $expected) : bool
    {
        return $this->getOnce($key) === $expected;
    }

    /**
     * Generate a random nonce value.
     *
     * @param integer $length Length of the generated value, in bytes.
     *
     * @return string
     *
     * @codeCoverageIgnore
     */
    private function getNonce(int $length = 16) : string
    {
        try {
            $random_bytes = random_bytes($length);
        } catch (\Exception $e) {
            $random_bytes = openssl_random_pseudo_bytes($length);
        }

        return bin2hex($random_bytes);
    }
}
