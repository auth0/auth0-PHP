<?php
declare(strict_types=1);

namespace Auth0\SDK\Helpers;

use Auth0\SDK\API\Helpers\RequestBuilder;
use Auth0\SDK\Helpers\Cache\NoCacheHandler;
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
     *
     * @see https://www.php-fig.org/psr/psr-16/#12-definitions
     */
    private $ttl = 600;

    /**
     * Cache handler or null for no caching.
     *
     * @var CacheInterface|null
     */
    private $cache;

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
        $this->ttl           = self::CACHE_TTL;

        if (!empty($options['ttl'])) {
            $this->ttl = $options['ttl'];
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

        $cache_key    = md5($jwks_url);
        $cached_value = $use_cache ? $this->cache->get($cache_key) : null;
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

        $this->cache->set($cache_key, $keys, $this->ttl);
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
     *
     * @param string  $ttlSeconds  Number of seconds to keep a JWK in memory.
     */
    public function setTtl(int $ttlSeconds)
    {
        $this->ttl = $ttlSeconds;
        return $this;
    }

    /**
     * Clear a specific JWK from the cache,
     *
     * @param string  $jwks_url  Full URL to the JWKS.
     *
     * @return boolean
     */
    public function cacheDelete(string $jwksUri)
    {
        return $this->cache->delete(md5($jwksUri));
    }

    /**
     * Clear the JWK cache.
     *
     * @return boolean
     */
    public function cacheClear()
    {
        return $this->cache->clear();
    }
}
