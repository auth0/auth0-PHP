<?php

declare(strict_types=1);

namespace Auth0\SDK\Helpers;

use Auth0\SDK\API\Helpers\RequestBuilder;
use Auth0\SDK\Helpers\Cache\NoCacheHandler;
use Psr\SimpleCache\CacheInterface;

/**
 * Class JWKFetcher.
 */
class JWKFetcher
{
    /**
     * Default length of cache persistence. Defaults to 10 minutes.
     *
     * @see https://www.php-fig.org/psr/psr-16/#12-definitions
     */
    public const DEFAULT_CACHE_TTL = 600;

    /**
     * How long should the cache persist? Defaults to value of DEFAULT_CACHE_TTL.
     * We strongly encouraged you leave the default value.
     *
     * @see https://www.php-fig.org/psr/psr-16/#12-definitions
     */
    private $ttl = self::DEFAULT_CACHE_TTL;

    /**
     * Cache handler or null for no caching.
     */
    private ?CacheInterface $cache = null;

    /**
     * Cache for unique cache ids.
     * Key for each entry is the url to the JWK. Value is cache id.
     */
    private array $cachedEntryIds = [];

    /**
     * Options for the Guzzle HTTP client.
     */
    private array $guzzleOptions;

    /**
     * JWKFetcher constructor.
     *
     * @param CacheInterface|null $cache         Cache handler or null for no caching.
     * @param array               $guzzleOptions Guzzle HTTP options.
     * @param options             $options       Class options to apply at initializion.
     */
    public function __construct(
        ?CacheInterface $cache = null,
        array $guzzleOptions = [],
        array $options = []
    ) {
        if ($cache === null) {
            $cache = new NoCacheHandler();
        }

        $this->cache = $cache;
        $this->guzzleOptions = $guzzleOptions;

        if (isset($options['ttl'])) {
            $this->setTtl((int) $options['ttl']);
        }
    }

    /**
     * Get a specific kid from a JWKS.
     *
     * @param string      $kid     Key ID to get.
     * @param string|null $jwksUri JWKS URI to use, or fallback on class-level one.
     *
     * @return string|null
     */
    public function getKey(
        string $kid,
        ?string $jwksUri = null
    ): ?string {
        $keys = $this->getKeys($jwksUri);

        if (! empty($keys) && empty($keys[$kid])) {
            $keys = $this->getKeys($jwksUri, false);
        }

        return $keys[$kid] ?? null;
    }

    /**
     * Gets an array of keys from the JWKS as kid => x5c.
     *
     * @param string $url      Full URL to the JWKS.
     * @param bool   $useCache Set to false to skip cache check; default true to use caching.
     *
     * @return array
     */
    public function getKeys(
        ?string $url = null,
        bool $useCache = true
    ): array {
        $url = $url ?? $this->guzzleOptions['base_uri'] ?? '';
        $keys = [];

        if (! $url) {
            return [];
        }

        $cached_value = $useCache ? $this->getCacheEntry($url) : null;

        if (! empty($cached_value) && is_array($cached_value)) {
            return $cached_value;
        }

        $jwks = $this->requestJwks($url);

        if (! $jwks || ! isset($jwks['keys']) || ! count($jwks['keys'])) {
            return [];
        }

        foreach ($jwks['keys'] as $key) {
            if (empty($key['kid']) || empty($key['x5c']) || empty($key['x5c'][0])) {
                continue;
            }

            $keys[$key['kid']] = $this->convertCertToPem($key['x5c'][0]);
        }

        $this->setCacheEntry($url, $keys);
        return $keys;
    }

    /**
     * Set how long to cache JWKs in seconds.
     * We strongly encouraged you leave the default value.
     *
     * @param string $ttlSeconds Number of seconds to keep a JWK in memory.
     *
     * @throws CoreException  If $ttlSeconds is less than 60.
     */
    public function setTtl(
        int $ttlSeconds
    ): self {
        if ($ttlSeconds < 60) {
            throw new \Auth0\SDK\Exception\CoreException('TTL cannot be less than 60 seconds.');
        }

        $this->ttl = $ttlSeconds;
        return $this;
    }

    /**
     * Returns how long we are caching JWKs in seconds.
     */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /**
     * Generate a cache id to use for a URL.
     *
     * @param string $jwksUri Full URL to the JWKS.
     */
    public function getCacheKey(
        string $jwksUri
    ): string {
        if (isset($this->cachedEntryIds[$jwksUri])) {
            return $this->cachedEntryIds[$jwksUri];
        }

        $cacheKey = md5($jwksUri);

        $this->cachedEntryIds[$jwksUri] = $cacheKey;
        return $cacheKey;
    }

    /**
     * Get a specific JWK from the cache by it's URL.
     *
     * @param string $jwksUri Full URL to the JWKS.
     *
     * @return array|null
     */
    public function getCacheEntry(
        string $jwksUri
    ): ?array {
        $cache_key = $this->getCacheKey($jwksUri);
        $cached_value = $this->cache->get($cache_key);

        if (! empty($cached_value) && is_array($cached_value)) {
            return $cached_value;
        }

        return null;
    }

    /**
     * Add or overwrite a specific JWK from the cache.
     *
     * @param string $jwksUri Full URL to the JWKS.
     * @param array  $keys    An array representing the JWKS.
     */
    public function setCacheEntry(
        string $jwksUri,
        array $keys
    ): self {
        $cache_key = $this->getCacheKey($jwksUri);

        $this->cache->set($cache_key, $keys, $this->ttl);

        return $this;
    }

    /**
     * Remove a specific JWK from the cache by it's URL.
     *
     * @param string $jwksUri Full URL to the JWKS.
     */
    public function removeCacheEntry(
        string $jwksUri
    ): bool {
        return $this->cache->delete($this->getCacheKey($jwksUri));
    }

    /**
     * Clear the JWK cache.
     */
    public function clearCache(): bool
    {
        return $this->cache->clear();
    }

    /**
     * Convert a certificate to PEM format.
     *
     * @param string $cert X509 certificate to convert to PEM format.
     */
    protected function convertCertToPem(
        string $cert
    ): string {
        $output = '-----BEGIN CERTIFICATE-----' . PHP_EOL;
        $output .= chunk_split($cert, 64, PHP_EOL);
        $output .= '-----END CERTIFICATE-----' . PHP_EOL;
        return $output;
    }

    /**
     * Get a JWKS from a specific URL.
     *
     * @param string $url URL to the JWKS.
     *
     * @return array
     *
     * @throws RequestException When HTTP request fails. Reason for failure provided in exception message.
     * @throws ClientException  When the JWKS cannot be retrieved.
     */
    protected function requestJwks(
        string $url
    ): array {
        $options = $this->guzzleOptions + [ 'base_uri' => $url ];

        $request = new RequestBuilder(
            [
                'method' => 'GET',
                'guzzleOptions' => $options,
            ]
        );

        return $request->call();
    }
}
