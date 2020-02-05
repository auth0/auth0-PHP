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
     * How long should the cache persist? Set to 10 minutes.
     *
     * @see https://www.php-fig.org/psr/psr-16/#12-definitions
     */
    const CACHE_TTL = 600;

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
    private $httpOptions;

    /**
     * JWKS URI to use, set in $httpOptions['jwks_uri'].
     *
     * @var array
     */
    private $jwksUri;

    /**
     * JWKFetcher constructor.
     *
     * @param CacheInterface|null $cache      Cache handler or null for no caching.
     * @param array               $httOptions HTTP options, including Guzzle options.
     */
    public function __construct(CacheInterface $cache = null, array $httOptions = [])
    {
        if ($cache === null) {
            $cache = new NoCacheHandler();
        }

        $this->cache       = $cache;
        $this->httpOptions = $httOptions;
        $this->jwksUri     = $this->httpOptions['jwks_uri'] ?? null;
        unset( $this->httpOptions['jwks_uri'] );
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
        $jwksUri = $jwksUri ?? $this->jwksUri;
        $keys    = $this->getKeys( $jwksUri );

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
        $jwks_url = $jwks_url ?? $this->jwksUri;
        if (empty( $jwks_url )) {
            return [];
        }

        $cache_key = md5($jwks_url);
        $keys      = $use_cache ? $this->cache->get($cache_key) : [];
        if (is_array($keys) && ! empty($keys)) {
            return $keys;
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

        $this->cache->set($cache_key, $keys, self::CACHE_TTL);
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
        $request = new RequestBuilder([
            'domain' => $jwks_url,
            'method' => 'GET',
            'guzzleOptions' => $this->httpOptions
        ]);
        return $request->call();
    }
}
