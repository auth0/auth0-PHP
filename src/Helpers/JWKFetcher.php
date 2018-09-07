<?php

namespace Auth0\SDK\Helpers;

use Auth0\SDK\API\Helpers\RequestBuilder;
use Auth0\SDK\Helpers\Cache\CacheHandler;
use Auth0\SDK\Helpers\Cache\NoCacheHandler;

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
     * @var CacheHandler|NoCacheHandler|null
     */
    private $cache = null;

    /**
     * Options for the Guzzle HTTP client.
     *
     * @var array
     */
    private $guzzleOptions = null;

    /**
     * JWKFetcher constructor.
     *
     * @param CacheHandler|null $cache         Cache handler or null for no caching.
     * @param array             $guzzleOptions Options for the Guzzle HTTP client.
     */
    public function __construct(CacheHandler $cache = null, array $guzzleOptions = [])
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
    protected function convertCertToPem($cert)
    {
        $output  = '-----BEGIN CERTIFICATE-----'.PHP_EOL;
        $output .= chunk_split($cert, 64, PHP_EOL);
        $output .= '-----END CERTIFICATE-----'.PHP_EOL;
        return $output;
    }

    /**
     * Fetch x509 cert for RS256 token decoding.
     *
     * @param string      $domain Base domain for the JWKS, including scheme.
     * @param string|null $kid    Kid to use.
     * @param string      $path   Path to the JWKS from the $domain.
     *
     * @return mixed
     *
     * @throws \Exception If the Guzzle HTTP client cannot complete the request.
     */
    public function fetchKeys($domain, $kid = null, $path = '.well-known/jwks.json')
    {
        $jwks_url = $domain.$path;

        // Check for a cached JWKS value.
        $secret = $this->cache->get($jwks_url);
        if (! is_null($secret)) {
            return $secret;
        }

        $secret = [];

        $jwks = $this->getJwks( $domain, $path );

        if (! is_array( $jwks['keys'] ) || empty( $jwks['keys'] )) {
            return $secret;
        }

        // No kid passed so get the kid of the first JWK.
        if (is_null($kid)) {
            $kid = $this->getProp( $jwks, 'kid' );
        }

        $x5c = $this->getProp( $jwks, 'x5c', $kid );

        // Need the kid and x5c for a well-formed return value. 
        if (! is_null($kid) && ! is_null($x5c)) {
            $secret[$kid] = $this->convertCertToPem($x5c);
            $this->cache->set($jwks_url, $secret);
        }

        return $secret;
    }

    /**
     * Get a specific property from a JWKS using a key, if provided.
     *
     * @param array       $jwks JWKS to parse.
     * @param string      $prop Property to retrieve.
     * @param null|string $kid  Kid to check.
     *
     * @return null|string
     */
    public function getProp(array $jwks, $prop, $kid = null)
    {
        $r_key = null;
        if (! $kid) {
            // No kid indicated, get the first entry.
            $r_key = $jwks['keys'][0];
        } else {
            // Iterate through the JWKS for the correct kid.
            foreach ($jwks['keys'] as $key) {
                if (isset($key['kid']) && $key['kid'] === $kid) {
                    $r_key = $key;
                    break;
                }
            }
        }

        // If a key was not found or the property does not exist, return.
        if (is_null($r_key) || ! isset($r_key[$prop])) {
            return null;
        }

        // If the value is an array, get the first element.
        return is_array( $r_key[$prop] ) ? $r_key[$prop][0] : $r_key[$prop];
    }

    /**
     * Get a JWKS given a domain and path to call.
     *
     * @param string $domain Base domain for the JWKS, including scheme.
     * @param string $path   Path to the JWKS from the $domain.
     *
     * @return mixed|string
     */
    protected function getJwks($domain, $path)
    {
        $request = new RequestBuilder([
            'domain' => $domain,
            'basePath' => $path,
            'method' => 'GET',
            'guzzleOptions' => $this->guzzleOptions
        ]);
        return $request->call();
    }
}
