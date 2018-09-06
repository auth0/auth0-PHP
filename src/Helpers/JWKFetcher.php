<?php

namespace Auth0\SDK\Helpers;

use Auth0\SDK\API\Helpers\RequestBuilder;
use Auth0\SDK\Helpers\Cache\CacheHandler;
use Auth0\SDK\Helpers\Cache\NoCacheHandler;

/**
 * Class JWKFetcher
 *
 * @package Auth0\SDK\Helpers
 */
class JWKFetcher
{

    /**
     * Cache handler for retrieved JWKS data.
     *
     * @var CacheHandler|NoCacheHandler
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
     * @param CacheHandler|null $cache         Cache handler for retrieved JWKS data.
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
     * Convert a certificate to PEM.
     *
     * @param string $cert Certificate to convert.
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
     * Fetch JWKS from the token issuer.
     *
     * @param string      $domain    Typically the issuer for the JWKS being fetched; include a trailing slash.
     * @param null|string $jwks_path Path to the JWKS from the issuer domain; pass null to use $domain as the URL.
     *
     * @return array|mixed|null
     */
    public function fetchKeys($domain, $jwks_path = '.well-known/jwks.json')
    {
        // If the path parameter is empty, use the $domain parameter as a complete URL.
        if (empty( $jwks_path )) {
            $domain_parsed = parse_url( $domain );
            $domain        = $domain_parsed['scheme'].'://'.$domain_parsed['host'];
            $domain       .= empty( $domain_parsed['port'] ) ? '' : ':'.$domain_parsed['port'];
            $domain       .= '/';
            $jwks_path     = empty( $domain_parsed['path'] ) ? '' : substr( $domain_parsed['path'], 1 );
        }

        // Check if we have a cache entry for this URL.
        $url    = $domain.$jwks_path;
        $secret = $this->cache->get($url);
        if (! is_null($secret)) {
            return $secret;
        }

        $secret = [];

        // GET the JWKS URL.
        $request = new RequestBuilder([
            'domain' => $domain,
            'basePath' => $jwks_path,
            'method' => 'GET',
            'guzzleOptions' => $this->guzzleOptions
        ]);
        $jwks    = $request->call();

        // Nothing to return.
        if (empty( $jwks['keys'] ) || ! is_array( $jwks['keys'] )) {
            return $secret;
        }

        foreach ($jwks['keys'] as $key) {
            // Get the first kid and return the PEM-formatted x5c cert.
            if (! empty($key['kid']) && ! empty($key['x5c'])) {
                $secret[$key['kid']] = $this->convertCertToPem($key['x5c'][0]);
                $this->cache->set($url, $secret);
                break;
            }
        }

        return $secret;
    }
}
