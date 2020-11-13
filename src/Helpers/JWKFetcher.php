<?php
declare(strict_types=1);

namespace Auth0\SDK\Helpers;

use Auth0\SDK\API\Helpers\RequestBuilder;
use Auth0\SDK\Helpers\Cache\NoCacheHandler;
use Auth0\SDK\Exception\CoreException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Psr\SimpleCache\CacheInterface;

/**
 * Class JWKFetcher.
 *
 * @package Auth0\SDK\Helpers
 */
class JWKFetcher
{
    /**
     * Default length of cache persistence. Defaults to 10 minutes.
     *
     * @see https://www.php-fig.org/psr/psr-16/#12-definitions
     */
    const CACHE_TTL = 600;

    /**
     * How long should the cache persist? Defaults to value of CACHE_TTL.
     * We strongly encouraged you leave the default value.
     *
     * @see https://www.php-fig.org/psr/psr-16/#12-definitions
     */
    private $ttl = self::CACHE_TTL;

    /**
     * Cache handler or null for no caching.
     *
     * @var CacheInterface|null
     */
    private $cache;

    /**
     * Cache for unique cache ids.
     * Key for each entry is the url to the JWK. Value is cache id.
     *
     * @var array
     */
    private $cachedEntryIds = [];

    /**
     * Options for the Guzzle HTTP client.
     *
     * @var array
     */
    private $guzzleOptions;

    /**
     * JWKFetcher constructor.
     *
     * @param CacheInterface|null $cache         Cache handler or null for no caching.
     * @param array               $guzzleOptions Guzzle HTTP options.
     * @param options             $options       Class options to apply at initializion.
     */
    public function __construct(CacheInterface $cache = null, array $guzzleOptions = [], array $options = [])
    {
        if ($cache === null) {
            $cache = new NoCacheHandler();
        }

        $this->cache         = $cache;
        $this->guzzleOptions = $guzzleOptions;

        if (!empty($options['ttl'])) {
            $this->setTtl($options['ttl']);
        }
    }

    /**
     * Convert a certificate to PEM format.
     *
     * @param string $cert X509 certificate to convert to PEM format.
     *
     * @return string
     */
    protected function convertCertToPem(string $cert) : string
    {
        $output  = '-----BEGIN CERTIFICATE-----'.PHP_EOL;
        $output .= chunk_split($cert, 64, PHP_EOL);
        $output .= '-----END CERTIFICATE-----'.PHP_EOL;
        return $output;
    }

    /**
     * Get a specific kid from a JWKS.
     *
     * @param string      $kid     Key ID to get.
     * @param string|null $jwksUri JWKS URI to use, or fallback on class-level one.
     *
     * @return mixed|null
     */
    public function getKey(string $kid, string $jwksUri = null)
    {
        $keys = $this->getKeys( $jwksUri );

        if (! empty( $keys ) && empty( $keys[$kid] )) {
            $keys = $this->getKeys( $jwksUri, false );
        }

        return $keys[$kid] ?? null;
    }

    /**
     * Gets an array of keys from the JWKS as kid => x5c.
     *
     * @param string  $jwks_url  Full URL to the JWKS.
     * @param boolean $use_cache Set to false to skip cache check; default true to use caching.
     *
     * @return array
     */
    public function getKeys(string $jwks_url = null, bool $use_cache = true) : array
    {
        $jwks_url = $jwks_url ?? $this->guzzleOptions['base_uri'] ?? '';

        if (empty( $jwks_url )) {
            return [];
        }

        $cached_value = $use_cache ? $this->getCacheEntry($jwks_url) : null;

        if (! empty($cached_value) && is_array($cached_value)) {
            return $cached_value;
        }

        $jwks = $this->requestJwks($jwks_url);

        if (empty( $jwks ) || empty( $jwks['keys'] )) {
            return [];
        }

        $keys = [];
        foreach ($jwks['keys'] as $key) {
            if (empty( $key['kid'] ) || empty( $key['x5c'] ) || empty( $key['x5c'][0] )) {
                continue;
            }

            $keys[$key['kid']] = $this->convertCertToPem( $key['x5c'][0] );
        }

        $this->setCacheEntry($jwks_url, $keys);
        return $keys;
    }

    /**
     * Get a JWKS from a specific URL.
     *
     * @param string $jwks_url URL to the JWKS.
     *
     * @return array
     *
     * @throws RequestException If $jwks_url is empty or malformed.
     * @throws ClientException  If the JWKS cannot be retrieved.
     */
    protected function requestJwks(string $jwks_url) : array
    {
        $options = array_merge( $this->guzzleOptions, [ 'base_uri' => $jwks_url ] );

        $request = new RequestBuilder([
            'method' => 'GET',
            'guzzleOptions' => $options,
        ]);

        return $request->call();
    }

    /**
     * Set how long to cache JWKs in seconds.
     * We strongly encouraged you leave the default value.
     *
     * @param string  $ttlSeconds  Number of seconds to keep a JWK in memory.
     *
     * @return $this
     *
     * @throws CoreException  If $ttlSeconds is less than 60.
     */
    public function setTtl(int $ttlSeconds)
    {
        if ($ttlSeconds < 60) {
            throw new CoreException('TTL cannot be less than 60 seconds.');
        }

        $this->ttl = $ttlSeconds;
        return $this;
    }

    /**
     * Returns how long we are caching JWKs in seconds.
     *
     * @return integer
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * Generate a cache id to use for a URL.
     *
     * @param string  $jwks_url  Full URL to the JWKS.
     *
     * @return string
     */
    public function getCacheKey(string $jwksUri)
    {
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
     * @param string  $jwks_url  Full URL to the JWKS.
     *
     * @return null|array
     */
    public function getCacheEntry(string $jwksUri)
    {
        $cache_key    = $this->getCacheKey($jwksUri);
        $cached_value = $this->cache->get($cache_key);

        if (! empty($cached_value) && is_array($cached_value)) {
            return $cached_value;
        }

        return null;
    }

   /**
     * Add or overwrite a specific JWK from the cache.
     *
     * @param string  $jwks_url  Full URL to the JWKS.
     * @param array   $keys      An array representing the JWKS.
     *
     * @return $this
     */
    public function setCacheEntry(string $jwksUri, array $keys)
    {
        $cache_key = $this->getCacheKey($jwksUri);

        $this->cache->set($cache_key, $keys, $this->ttl);

        return $this;
    }

    /**
     * Remove a specific JWK from the cache by it's URL.
     *
     * @param string  $jwks_url  Full URL to the JWKS.
     *
     * @return boolean
     */
    public function removeCacheEntry(string $jwksUri)
    {
        return $this->cache->delete($this->getCacheKey($jwksUri));
    }

    /**
     * Clear the JWK cache.
     *
     * @return boolean
     */
    public function clearCache()
    {
        return $this->cache->clear();
    }
}
