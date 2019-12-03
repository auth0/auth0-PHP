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
     * @param array               $guzzleOptions Options for the Guzzle HTTP client.
     */
    public function __construct(CacheInterface $cache = null, array $guzzleOptions = [])
    {
        if ($cache === null) {
            $cache = new NoCacheHandler();
        }

        $this->cache         = $cache;
        $this->guzzleOptions = $guzzleOptions;
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
     * Gets an array of keys from the JWKS as kid => x5c.
     *
     * @param string $jwks_url Full URL to the JWKS.
     *
     * @return array
     */
    public function getKeys(string $jwks_url) : array
    {
        $cache_key = md5($jwks_url);
        $keys      = $this->cache->get($cache_key);
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

        $this->cache->set($cache_key, $keys);
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
            'guzzleOptions' => $this->guzzleOptions
        ]);
        return $request->call();
    }
}
