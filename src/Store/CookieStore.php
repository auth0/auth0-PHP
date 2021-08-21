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
final class CookieStore implements StoreInterface
{
    public const KEY_HASHING_ALGO = 'sha256';
    public const KEY_CHUNKING_THRESHOLD = 3072;
    public const KEY_SEPARATOR = '_';
    public const VAL_CRYPTO_ALGO = 'aes-128-gcm';

    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private SdkConfiguration $configuration;

    /**
     * Cookie base name.
     * Use 'namespace' argument to set this during instantiation.
     */
    private string $namespace;

    /**
     * The threshold (in bytes) in which chunking/splitting occurs.
     */
    private int $threshold;

    /**
     * Internal cache of the storage state.
     *
     * @var array<mixed>
     */
    private array $store = [];

    /**
     * When true, CookieStore will not setState() itself. You will need manually call the method to persist state to storage.
     */
    private bool $deferring = false;

    /**
     * CookieStore constructor.
     *
     * @param SdkConfiguration $configuration   Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     * @param string           $namespace       A string in which to store cookies under on devices.
     */
    public function __construct(
        SdkConfiguration $configuration,
        string $namespace = 'auth0'
    ) {
        [$namespace] = Toolkit::filter([$namespace])->string()->trim();

        Toolkit::assert([
            [$namespace, \Auth0\SDK\Exception\ArgumentException::missing('namespace')],
        ])->isString();

        $this->configuration = $configuration;
        $this->namespace = hash(self::KEY_HASHING_ALGO, $namespace ?? 'auth0');
        $this->threshold = self::KEY_CHUNKING_THRESHOLD - strlen($this->namespace) + 2;

        $this->getState();
    }

    /**
     * Returns the current namespace identifier.
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * Returns the current threshold for chunk size calculations.
     */
    public function getThreshold(): int
    {
        return $this->threshold;
    }

    /**
     * Defer saving state changes to destination to improve performance during blocks of changes.
     *
     * @param bool $deferring Whether to defer persisting the storage state.
     */
    public function defer(
        bool $deferring
    ): void {
        if ($this->deferring === true && $deferring === false) {
            $this->setState();
        }

        $this->deferring = $deferring;
    }

    /**
     * Setup our storage state by pulling from persistence source.
     *
     * @param array<mixed> $state Skip loading any persistent source state and inject a custom state.
     *
     * @return array<mixed>
     */
    public function getState(
        ?array $state = null
    ): array {
        if ($state !== null) {
            return $this->store = $state;
        }

        $data = '';
        $index = 0;

        while (true) {
            $cookieName = $this->namespace . self::KEY_SEPARATOR . $index;

            if (! isset($_COOKIE[$cookieName])) {
                break;
            }

            if (is_string($_COOKIE[$cookieName])) {
                $data .= $_COOKIE[$cookieName];
            }

            $index++;
        }

        if (mb_strlen($data) === 0) {
            return $this->store = [];
        }

        $data = $this->decrypt($data);
        $this->store = $data ?? [];

        if ($data === null) {
            $this->setState();
        }

        return $this->store;
    }

    /**
     * Push our storage state to the source for persistence.
     */
    public function setState(): self
    {
        $setOptions = $this->getCookieOptions();
        $deleteOptions = $this->getCookieOptions(-1000);
        $existing = [];
        $using = [];

        foreach ($_COOKIE as $cookieName => $_) {
            $cookieBeginsWith = $this->namespace . self::KEY_SEPARATOR;

            if (strlen($cookieName) >= strlen($cookieBeginsWith) &&
                mb_substr($cookieName, 0, strlen($cookieBeginsWith)) === $cookieBeginsWith) {
                $existing[] = $cookieName;
            }
        }

        if (count($this->store) !== 0) {
            $encrypted = $this->encrypt($this->store);

            // @phpstan-ignore-next-line
            $chunks = str_split($encrypted, $this->threshold);

            // @phpstan-ignore-next-line
            if ($chunks !== false) {
                foreach ($chunks as $index => $chunk) {
                    $cookieName = $this->namespace . self::KEY_SEPARATOR . $index;
                    $_COOKIE[$cookieName] = $chunk;
                    setcookie($cookieName, $chunk, $setOptions);
                    $using[] = $cookieName;
                }
            }
        }

        $orphaned = array_diff($existing, $using);

        foreach ($orphaned as $cookieName) {
            setcookie($cookieName, '', $deleteOptions);
            unset($_COOKIE[$cookieName]);
        }

        return $this;
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
        [$key] = Toolkit::filter([$key])->string()->trim();

        Toolkit::assert([
            [$key, \Auth0\SDK\Exception\ArgumentException::missing('key')],
        ])->isString();

        $this->store[$key ?? ''] = $value;

        if ($this->deferring === false) {
            $this->setState();
        }
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
        [$key] = Toolkit::filter([$key])->string()->trim();

        Toolkit::assert([
            [$key, \Auth0\SDK\Exception\ArgumentException::missing('key')],
        ])->isString();

        return $this->store[$key] ?? $default;
    }

    /**
     * Removes a persisted value identified by $key.
     *
     * @param string $key Cookie to delete.
     */
    public function delete(
        string $key
    ): void {
        [$key] = Toolkit::filter([$key])->string()->trim();

        Toolkit::assert([
            [$key, \Auth0\SDK\Exception\ArgumentException::missing('key')],
        ])->isString();

        unset($this->store[$key ?? '']);

        if ($this->deferring === false) {
            $this->setState();
        }
    }

    /**
     * Removes all persisted values.
     */
    public function purge(): void
    {
        $this->store = [];

        if ($this->deferring === false) {
            $this->setState();
        }
    }

    /**
     * Encrypt data for safe storage format for a cookie.
     *
     * @param array<mixed> $data Data to encrypt.
     */
    private function encrypt(
        array $data
    ): string {
        $secret = $this->configuration->getCookieSecret();
        $ivLen = openssl_cipher_iv_length(self::VAL_CRYPTO_ALGO);

        if ($secret === null) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresCookieSecret();
        }

        // @codeCoverageIgnoreStart
        if ($ivLen === false) {
            return '';
        }
        // @codeCoverageIgnoreEnd

        $iv = openssl_random_pseudo_bytes($ivLen);

        // @codeCoverageIgnoreStart
        // @phpstan-ignore-next-line
        if ($iv === false) {
            return '';
        }
        // @codeCoverageIgnoreEnd

        $encrypted = openssl_encrypt(serialize($data), self::VAL_CRYPTO_ALGO, $secret, 0, $iv, $tag);
        return base64_encode(json_encode(serialize(['tag' => base64_encode($tag), 'iv' => base64_encode($iv), 'data' => $encrypted]), JSON_THROW_ON_ERROR));
    }

    /**
     * Decrypt data from a stored cookie string.
     *
     * @param string $data String representing an encrypted data structure.
     *
     * @return array<mixed>|null
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

        if (! is_string($data)) {
            return null;
        }

        $data = unserialize($data);

        if (! isset($data['iv']) || ! isset($data['tag']) || ! is_string($data['iv']) || ! is_string($data['tag'])) {
            return null;
        }

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
