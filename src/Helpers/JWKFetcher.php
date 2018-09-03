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
     * Fetch
     *
     * @param string      $iss       Issuer for the JWKS being fetched.
     * @param null|string $jwks_path Path to the JWKS from the issuer domain.
     *
     * @return array|mixed|null
     */
    public function fetchKeys($iss, $jwks_path = null)
    {
        if (empty( $jwks_path )) {
            $jwks_path = '.well-known/jwks.json';
        }

        $url = $iss.$jwks_path;

        $secret = $this->cache->get($url);
        if (is_null($secret)) {
            $secret = [];

            $request = new RequestBuilder([
                'domain' => $iss,
                'basePath' => $jwks_path,
                'method' => 'GET',
                'guzzleOptions' => $this->guzzleOptions
            ]);
            $jwks    = $request->call();

            foreach ($jwks['keys'] as $key) {
                if (empty( $key['kid'] )) {
                    continue;
                }

                $secret[$key['kid']] = $this->convertCertToPem($key['x5c'][0]);
            }

            $this->cache->set($url, $secret);
        }

        return $secret;
    }
}
