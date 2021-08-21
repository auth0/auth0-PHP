<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Utility\Toolkit;

/**
 * Class CookieStore.
 * This class provides a layer to persist transient auth data using cookies.
 */
class CookieStore implements StoreInterface
{
    public const KEY_HASHING_ALGO = 'sha256';
    public const KEY_CHUNKING_THRESHOLD = 4096;
    public const KEY_SEPARATOR = '_';
    public const VAL_CRYPTO_ALGO = 'aes-128-gcm';

    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private SdkConfiguration $configuration;

    /**
     * Cookie base name.
     * Use 'cookiePrefix' argument to set this during instantiation.
     */
    private string $cookiePrefix;

    /**
     * Number of bytes to deduct/buffer from KEY_CHUNKING_THRESHOLD before chunking begins.
     */
    private int $chunkingThreshold;

    /**
     * CookieStore constructor.
     *
     * @param SdkConfiguration $configuration   Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     * @param string           $cookiePrefix    A string to prefix stored cookie keys with.
     */
    public function __construct(
        SdkConfiguration $configuration,
        string $cookiePrefix = 'auth0'
    ) {
        [$cookiePrefix] = Toolkit::filter([$cookiePrefix])->string()->trim();

        Toolkit::assert([
            [$cookiePrefix, \Auth0\SDK\Exception\ArgumentException::missing('cookiePrefix')],
        ])->isString();

        $this->configuration = $configuration;
        $this->cookiePrefix = $cookiePrefix ?? 'auth0';

        $this->chunkingThreshold = self::KEY_CHUNKING_THRESHOLD - strlen(hash(self::KEY_HASHING_ALGO, 'threshold'));
    }

    /**
     * Persists $value on cookies, identified by $key.
     *
     * @param string $key   Cookie to set.
     * @param mixed  $value Value to use.
     */
    public function set(
        string $key,
        $value
    ): void {
        $key = $this->getCookieName($key);
        $cookieOptions = $this->getCookieOptions();

        $value = $this->encrypt($value);

        $_COOKIE[$key] = $value;

        if (strlen($value) >= $this->chunkingThreshold) {
            // @phpstan-ignore-next-line
            $chunks = str_split($value, $this->chunkingThreshold);

            // @phpstan-ignore-next-line
            if ($chunks !== false) {
                $chunkIndex = 1;

                setcookie(join(self::KEY_SEPARATOR, [ $key, '0']), (string) count($chunks), $cookieOptions);

                foreach ($chunks as $chunk) {
                    setcookie(join(self::KEY_SEPARATOR, [ $key, $chunkIndex]), $chunk, $cookieOptions);
                    $chunkIndex++;
                }

                return;
            }
        }

        setcookie($key, $value, $cookieOptions);
    }

    /**
     * Gets persisted values identified by $key.
     * If the value is not set, returns $default.
     *
     * @param string $key     Cookie to set.
     * @param mixed  $default Default to return if nothing was found.
     *
     * @return mixed
     */
    public function get(
        string $key,
        $default = null
    ) {
        $key = $this->getCookieName($key);
        $chunks = $this->isCookieChunked($key);
        $value = '';

        if ($chunks === null) {
            return $default;
        }

        if ($chunks !== 0) {
            for ($chunk = 1; $chunk <= $chunks; $chunk++) {
                $chunkData = $_COOKIE[join(self::KEY_SEPARATOR, [ $key, $chunk])] ?? null;

                if ($chunkData === null) {
                    return $default;
                }

                $value .= (string) $chunkData;
            }
        }

        if ($chunks === 0) {
            $value = $_COOKIE[$key] ?? null;
        }

        if ($value !== null && mb_strlen($value) !== 0) {
            $data = $this->decrypt($value);

            if ($data !== null) {
                return $data;
            }
        }

        return $default;
    }

    /**
     * Removes all persisted values.
     */
    public function deleteAll(): void
    {
        $cookies = $_COOKIE;
        $prefix = $this->cookiePrefix . '_';

        while (current($cookies)) {
            $cookieName = key($cookies);

            if (is_string($cookieName) && mb_substr($cookieName, 0, strlen($prefix)) === $prefix) {
                $this->delete($cookieName, false);
            }

            next($cookies);
        }
    }

    /**
     * Removes a persisted value identified by $key.
     *
     * @param string $key    Cookie to delete.
     * @param bool   $prefix Whether the cookie name should have the $cookiePrefix applied.
     */
    public function delete(
        string $key,
        bool $prefix = true
    ): void {
        $key = $this->getCookieName($key, $prefix);
        $chunks = $this->isCookieChunked($key);

        if ($chunks === null) {
            return;
        }

        $cookieOptions = $this->getCookieOptions(-1000);

        unset($_COOKIE[$key]);
        setcookie($key, '', $cookieOptions);

        if ($chunks !== 0) {
            unset($_COOKIE[join(self::KEY_SEPARATOR, [ $key, '0'])]);
            setcookie(join(self::KEY_SEPARATOR, [ $key, '0']), '', $cookieOptions);

            for ($chunk = 1; $chunk <= $chunks; $chunk++) {
                unset($_COOKIE[join(self::KEY_SEPARATOR, [ $key, $chunk])]);
                setcookie(join(self::KEY_SEPARATOR, [ $key, $chunk]), '', $cookieOptions);
            }
        }
    }

    /**
     * Constructs a cookie name.
     *
     * @param string $key Cookie name to prefix and return.
     * @param bool   $prefix Whether the cookie name should have the $cookiePrefix applied.
     */
    public function getCookieName(
        string $key,
        bool $prefix = true
    ): string {
        [$key] = Toolkit::filter([$key])->string()->trim();

        Toolkit::assert([
            [$key, \Auth0\SDK\Exception\ArgumentException::missing('key')],
        ])->isString();

        if ($prefix) {
            return $this->cookiePrefix . '_' . hash(self::KEY_HASHING_ALGO, $key ?? '');
        }

        return $key ?? '';
    }

    /**
     * Determine the chunkiness of a cookie. Returns the number of chunks, or 0 if unchunked. If the cookie wasn't found, returns null.
     *
     * @param string $key Cookie name to lookup.
     */
    private function isCookieChunked(
        string $key
    ): ?int {
        [$key] = Toolkit::filter([$key])->string()->trim();

        Toolkit::assert([
            [$key, \Auth0\SDK\Exception\ArgumentException::missing('key')],
        ])->isString();

        if (isset($_COOKIE[join(self::KEY_SEPARATOR, [ $key, '0'])])) {
            return (int) $_COOKIE[join(self::KEY_SEPARATOR, [ $key, '0'])];
        }

        if (isset($_COOKIE[$key])) {
            return 0;
        }

        return null;
    }

    /**
     * Encrypt data for safe storage format for a cookie.
     *
     * @param mixed $data Data to encrypt.
     */
    private function encrypt(
        $data
    ): string {
        $secret = $this->configuration->getCookieSecret();
        $ivLen = openssl_cipher_iv_length(self::VAL_CRYPTO_ALGO);

        if ($secret === null) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresCookieSecret();
        }

        if ($ivLen === false) {
            return '';
        }

        $iv = openssl_random_pseudo_bytes($ivLen);

        // @phpstan-ignore-next-line
        if ($iv === false) {
            return '';
        }

        $encrypted = openssl_encrypt(serialize($data), self::VAL_CRYPTO_ALGO, $secret, 0, $iv, $tag);
        return base64_encode(json_encode(serialize(['tag' => base64_encode($tag), 'iv' => base64_encode($iv), 'data' => $encrypted]), JSON_THROW_ON_ERROR));
    }

    /**
     * Decrypt data from a stored cookie string.
     *
     * @param string $data String representing an encrypted data structure.
     *
     * @return mixed
     */
    private function decrypt(
        string $data
    ) {
        [$data] = Toolkit::filter([$data])->string()->trim();

        Toolkit::assert([
            [$data, \Auth0\SDK\Exception\ArgumentException::missing('data')],
        ])->isString();

        $secret = $this->configuration->getCookieSecret();

        if ($secret === null) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresCookieSecret();
        }

        $data = base64_decode($data ?? '', true);

        if ($data === false) {
            return null;
        }

        $data = json_decode($data, true);

        if ($data === null) {
            return null;
        }

        $data = unserialize($data);
        $iv = base64_decode($data['iv'], true);
        $tag = base64_decode($data['tag'], true);

        if ($iv === false || $tag === false) {
            return null;
        }

        $data = openssl_decrypt($data['data'], self::VAL_CRYPTO_ALGO, $secret, 0, $iv, $tag);

        if ($data === false) {
            return null;
        }

        return unserialize($data);
    }

    /**
     * Build options array for use with setcookie()
     *
     * @param int|null $expires
     *
     * @return array<mixed>
     */
    private function getCookieOptions(
        ?int $expires = null
    ): array {
        $expires = $expires ?? $this->configuration->getCookieExpires();

        if ($expires !== 0) {
            $expires = time() + $expires;
        }

        $options = [
            'expires' => $expires,
            'path' => $this->configuration->getCookiePath(),
            'secure' => $this->configuration->getCookieSecure(),
            'httponly' => true,
            'samesite' => $this->configuration->getResponseMode() === 'form_post' ? 'None' : 'Lax',
        ];

        $domain = $this->configuration->getCookieDomain() ?? $_SERVER['HTTP_HOST'] ?? null;

        if ($domain !== null) {
            $options['domain'] = $domain;
        }

        return $options;
    }
}
