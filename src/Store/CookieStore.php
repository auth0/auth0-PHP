<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Utility\Toolkit;

use function defined;
use function in_array;
use function is_array;
use function is_int;
use function is_string;

/**
 * This class provides a layer to persist transient auth data using cookies.
 */
final class CookieStore implements StoreInterface
{
    /**
     * @var int
     */
    public const KEY_CHUNKING_THRESHOLD = 2048;

    /**
     * @var string
     */
    public const KEY_HASHING_ALGO = 'sha256';

    /**
     * @var string
     */
    public const KEY_SEPARATOR = '_';

    /**
     * @var string
     */
    public const VAL_CRYPTO_ALGO = 'aes-128-gcm';

    /**
     * When true, CookieStore will not setState() itself. You will need manually call the method to persist state to storage.
     */
    private bool $deferring = false;

    /**
     * Determine if changes have been made since the last setState.
     */
    private bool $dirty = false;

    /**
     * Determine if changes have been made since the last setState.
     */
    private bool $encrypt = true;

    /**
     * Internal cache of the storage state.
     *
     * @var array<mixed>
     */
    private array $store = [];

    /**
     * CookieStore constructor.
     *
     * @param SdkConfiguration $configuration Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     * @param string           $namespace     a string in which to store cookies under on devices
     *
     * @psalm-suppress RedundantCondition
     */
    public function __construct(
        private SdkConfiguration $configuration,
        private string $namespace = 'auth0',
    ) {
        $this->getState();
    }

    /**
     * Decrypt data from a stored cookie string.
     *
     * @param string $data string representing an encrypted data structure
     *
     * @return null|array<mixed>
     *
     * @psalm-suppress TypeDoesNotContainType
     */
    public function decrypt(
        string $data,
    ): ?array {
        if (! $this->encrypt) {
            $decoded = rawurldecode($data);
            $decoded = json_decode($decoded, true);

            if (is_array($decoded)) {
                return $decoded;
            }

            return [];
        }

        [$data] = Toolkit::filter([$data])->string()->trim();

        Toolkit::assert([
            [$data, \Auth0\SDK\Exception\ArgumentException::missing('data')],
        ])->isString();

        $secret = $this->configuration->getCookieSecret();

        if (null === $secret) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresCookieSecret();
        }

        $decoded = rawurldecode((string) $data);
        $stripped = stripslashes($decoded);
        $data = json_decode($stripped, true, 512);

        /** @var array{iv?: null|int|string, tag?: null|int|string, data: string} $data */
        if (! isset($data['iv']) || ! isset($data['tag']) || ! is_string($data['iv']) || ! is_string($data['tag'])) {
            return null;
        }

        $iv = base64_decode($data['iv'], true);
        $tag = base64_decode($data['tag'], true);

        if (! is_string($iv) || ! is_string($tag)) {
            return null;
        }

        $data = openssl_decrypt($data['data'], self::VAL_CRYPTO_ALGO, $secret, 0, $iv, $tag);

        if (! is_string($data)) {
            return null;
        }

        $data = json_decode($data, true);

        return is_array($data) ? $data : null;
    }

    /**
     * Defer saving state changes to destination to improve performance during blocks of changes.
     *
     * @param bool $deferring whether to defer persisting the storage state
     */
    public function defer(
        bool $deferring,
    ): void {
        $this->deferring = $deferring;

        // If we were deferring state saving and we've been asked to cancel that deference
        if (! $deferring) {
            // Immediately push the state to the host device.
            $this->setState();
        }
    }

    /**
     * Removes a persisted value identified by $key.
     *
     * @param string $key cookie to delete
     */
    public function delete(
        string $key,
    ): void {
        [$key] = Toolkit::filter([$key])->string()->trim();

        Toolkit::assert([
            [$key, \Auth0\SDK\Exception\ArgumentException::missing('key')],
        ])->isString();

        if (isset($this->store[(string) $key])) {
            unset($this->store[(string) $key]);
            $this->dirty = true;
        }

        if (! $this->deferring) {
            $this->setState();
        }
    }

    /**
     * Encrypt data for safe storage format for a cookie.
     *
     * @param array<mixed> $data    data to encrypt
     * @param array<mixed> $options additional configuration options
     *
     * @psalm-suppress TypeDoesNotContainType
     */
    public function encrypt(
        array $data,
        array $options = [],
    ): string {
        if (! $this->encrypt) {
            $data = $options['encoded1'] ?? json_encode($data);

            if (! is_string($data)) {
                return '';
            }

            return rawurlencode($data);
        }

        $secret = $this->configuration->getCookieSecret();
        $ivLen = $options['ivLen'] ?? openssl_cipher_iv_length(self::VAL_CRYPTO_ALGO);
        $tag = null;

        if (null === $secret) {
            throw \Auth0\SDK\Exception\ConfigurationException::requiresCookieSecret();
        }

        if (! is_int($ivLen)) {
            return '';
        }

        $iv = $options['iv'] ?? openssl_random_pseudo_bytes($ivLen);

        if (! is_string($iv)) {
            return '';
        }

        $data = $options['encoded1'] ?? json_encode($data);

        if (! is_string($data)) {
            return '';
        }

        // Encrypt the PHP array.
        $encrypted = $options['encrypted'] ?? openssl_encrypt($data, self::VAL_CRYPTO_ALGO, $secret, 0, $iv, $tag);
        $iv = $options['iv'] ?? $iv;
        $tag = $options['tag'] ?? $tag;

        if (! is_string($encrypted)) {
            return '';
        }

        if (! is_string($tag)) {
            return '';
        }

        // Return a JSON encoded object containing the crypto tag and iv, and the encrypted data.
        $encoded = $options['encoded2'] ?? json_encode(['tag' => base64_encode($tag), 'iv' => base64_encode($iv), 'data' => $encrypted]);

        if (is_string($encoded)) {
            return rawurlencode($encoded);
        }

        return '';
    }

    /**
     * Gets persisted values identified by $key.
     * If the value is not set, returns $default.
     *
     * @param string $key     cookie to set
     * @param mixed  $default default to return if nothing was found
     *
     * @return mixed
     */
    public function get(
        string $key,
        $default = null,
    ) {
        [$key] = Toolkit::filter([$key])->string()->trim();

        Toolkit::assert([
            [$key, \Auth0\SDK\Exception\ArgumentException::missing('key')],
        ])->isString();

        return $this->store[$key] ?? $default;
    }

    /**
     * Build options array for use with setcookie().
     *
     * @param ?int $expires
     *
     * @return array{expires: int, path: string, domain?: string, secure: bool, httponly: bool, samesite: string, url_encode?: int}
     */
    public function getCookieOptions(
        ?int $expires = null,
    ): array {
        $expires ??= $this->configuration->getCookieExpires();

        if (0 !== $expires) {
            $expires = time() + $expires;
        }

        $options = [
            'expires' => $expires,
            'path' => $this->configuration->getCookiePath(),
            'secure' => $this->configuration->getCookieSecure(),
            'httponly' => true,
            'samesite' => 'form_post' === $this->configuration->getResponseMode() ? 'None' : $this->configuration->getCookieSameSite() ?? 'Lax',
        ];

        if (! in_array(mb_strtolower($options['samesite']), ['lax', 'none', 'strict'], true)) {
            $options['samesite'] = 'Lax';
        }

        $domain = $this->configuration->getCookieDomain() ?? null;
        $httpHost = $_SERVER['HTTP_HOST'] ?? 'UNAVAILABLE';

        if (null !== $domain && $domain !== $httpHost) {
            $options['domain'] = $domain;
        }

        return $options;
    }

    /**
     * Returns the current encryption state.
     */
    public function getEncrypted(): bool
    {
        return $this->encrypt;
    }

    /**
     * Returns the current namespace identifier.
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * Setup our storage state by pulling from persistence source.
     *
     * @param null|mixed[] $state skip loading any persistent source state and inject a custom state
     *
     * @return array<mixed>
     */
    public function getState(
        ?array $state = null,
    ): array {
        // Overwrite our internal state with one passed (presumably during unit tests.)
        if (null !== $state) {
            if ($this->store !== $state) {
                $this->dirty = true;
            }

            return $this->store = $state;
        }

        $data = '';
        $index = 0;

        // Iterate over cookies on the host device and pull those belonging to us.
        while (true) {
            // Look for the next cookie with an index suffix indicating chunking; starts at 0.
            $cookieName = $this->namespace . self::KEY_SEPARATOR . $index;

            // No cookies remain to be combined; exit the loop.
            if (! isset($_COOKIE[$cookieName])) {
                break;
            }

            // A chunked cookie was found; affix it's value to $data for decryption.
            $data .= $_COOKIE[$cookieName];

            // Increment the index for next loop and look for another chunk.
            ++$index;
        }

        // If no cookies were found, set an empty state and continue.
        if ('' === $data) {
            return $this->store = [];
        }

        // Decrypt the combined values of the chunked cookies.
        $data = $this->decrypt($data);

        // If cookies were undecryptable, default to an empty state.
        $this->store = $data ?? [];

        // If cookies were undecryptable, push the updated empty state to the browser.
        if (null === $data) {
            $this->setState();
        }

        return $this->store;
    }

    /**
     * Removes all persisted values.
     */
    public function purge(): void
    {
        if ([] !== $this->store) {
            $this->store = [];
            $this->dirty = true;
        }

        if (! $this->deferring) {
            $this->setState();
        }
    }

    /**
     * Persists $value on cookies, identified by $key.
     *
     * @param string $key   cookie to set
     * @param mixed  $value value to use
     */
    public function set(
        string $key,
        $value,
    ): void {
        [$key] = Toolkit::filter([$key])->string()->trim();

        Toolkit::assert([
            [$key, \Auth0\SDK\Exception\ArgumentException::missing('key')],
        ])->isString();

        if (! isset($this->store[(string) $key]) || $this->store[(string) $key] !== $value) {
            $this->store[(string) $key] = $value;
            $this->dirty = true;
        }

        if (! $this->deferring) {
            $this->setState();
        }
    }

    /**
     * Toggle the encryption state.
     *
     * @param bool $encrypt enable or disable cookie encryption
     */
    public function setEncrypted(bool $encrypt = true): self
    {
        $this->encrypt = $encrypt;

        return $this;
    }

    /**
     * Push our storage state to the source for persistence.
     *
     * @psalm-suppress UnusedFunctionCall,DocblockTypeContradiction,NoValue,InvalidCast
     *
     * @param bool $force
     */
    public function setState(
        bool $force = false,
    ): self {
        if (! $this->dirty && ! $force) {
            return $this;
        }

        $setOptions = $this->getCookieOptions();
        $deleteOptions = $this->getCookieOptions(-1000);
        $existing = [];
        $using = [];

        // Iterate through the host device cookies and collect a list of ones that belong to us.
        foreach (array_keys($_COOKIE) as $cookieName) {
            $cookieBeginsWith = $this->namespace . self::KEY_SEPARATOR;

            if (is_int($cookieName)) {
                $cookieName = (string) $cookieName;
            }

            if (mb_strlen($cookieName) >= mb_strlen($cookieBeginsWith)
                && mb_substr($cookieName, 0, mb_strlen($cookieBeginsWith)) === $cookieBeginsWith) {
                $existing[] = $cookieName;
            }
        }

        // Check if we have anything in memory to encrypt and store on the host device.
        if ([] !== $this->store) {
            // Return an encrypted string representing our memory state.
            $encrypted = $this->encrypt($this->store);

            /**
             * Cookies have a finite size limit. If ours is too large, "chunk" it (split it into multiple cookies.).
             *
             * @phpstan-ignore-next-line
             */
            $threshold = self::KEY_CHUNKING_THRESHOLD - mb_strlen($this->namespace);

            if ($threshold > 0) {
                $chunks = mb_str_split($encrypted, $threshold);

                // Store each "chunk" as a separate cookie on the host device.
                foreach ($chunks as $index => $chunk) {
                    // Add a '_X' index suffix to each chunked cookie; we'll use this to iterate over all when we rejoin the cookie for decryption.
                    $cookieName = $this->namespace . self::KEY_SEPARATOR . $index;

                    // Update PHP's internal _COOKIE global with the chunked cookie.
                    $_COOKIE[$cookieName] = $chunk;

                    // Push the updated cookie to the host device for persistence.
                    // @codeCoverageIgnoreStart
                    if (! defined('AUTH0_TESTS_DIR')) {
                        /** @var array{expires?: int, path?: string, domain?: string, secure?: bool, httponly?: bool, samesite?: 'Lax'|'lax'|'None'|'none'|'Strict'|'strict', url_encode?: int} $setOptions */
                        setrawcookie($cookieName, $chunk, $setOptions);
                    }
                    // @codeCoverageIgnoreEnd

                    // Keep track of the cookie names in use., _1, _2, _3, and so on.
                    $using[] = $cookieName;
                }
            }
        }

        // Compare cookies already present on the device with those we're now using, and delete ones no longer in use.
        // For example, if a user was signed in previously, they may have had 3 or 4 chunked cookies (_1, _2, _3, _4)
        // Suppose they then signed out; they'd be using none of those cookies. _1, _2, _3 and _4 would be orphaned.
        // We must delete these extraneous cookies, or it will corrupt decryption attempts next time getState() is invoked.
        $orphaned = array_diff($existing, $using);

        foreach ($orphaned as $cookieName) {
            // Push the cookie deletion command to the host device.
            // @codeCoverageIgnoreStart
            if (! defined('AUTH0_TESTS_DIR')) {
                /** @var array{expires?: int, path?: string, domain?: string, secure?: bool, httponly?: bool, samesite?: 'Lax'|'lax'|'None'|'none'|'Strict'|'strict', url_encode?: int} $deleteOptions */
                setrawcookie($cookieName, '', $deleteOptions);
            }
            // @codeCoverageIgnoreEnd

            // Clear PHP's internal COOKIE global of the orphaned cookie.
            unset($_COOKIE[$cookieName]);
        }

        $this->dirty = false;

        return $this;
    }
}
