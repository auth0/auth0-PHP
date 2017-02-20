<?php

namespace Auth0\SDK\Helpers;

use Auth0\SDK\API\Helpers\RequestBuilder;
use Auth0\SDK\Helpers\Cache\CacheHandler;
use Auth0\SDK\Helpers\Cache\NoCacheHandler;

class JWKFetcher {

    /**
     * @var CacheHandler|NoCacheHandler
     */
    private $cache = null;

    /**
     * @var array
     */
    private $guzzleOptions = null;

    /**
     * JWKFetcher constructor.
     * @param CacheHandler|null $cache
     * @param array $guzzleOptions
     */
    public function __construct(CacheHandler $cache = null, $guzzleOptions = []) {
        if ($cache === null) {
            $cache = new NoCacheHandler();
        }

        $this->cache = $cache;
        $this->guzzleOptions = $guzzleOptions;
    }

    /**
     * @param string $cert
     * @return string
     */
    protected function convertCertToPem($cert) {
        return '-----BEGIN CERTIFICATE-----'.PHP_EOL
            .chunk_split($cert, 64, PHP_EOL)
            .'-----END CERTIFICATE-----'.PHP_EOL;
    }

    /**
     * @param string $iss
     * @return array|null
     */
    public function fetchKeys($iss) {
        $url = "{$iss}.well-known/jwks.json";

        if (($secret = $this->cache->get($url)) === null) {

            $secret = [];

            $request = new RequestBuilder(array(
                'domain' => $iss,
                'basePath' => '.well-known/jwks.json',
                'method' => 'GET',
                'guzzleOptions' => $this->guzzleOptions
            ));
            $jwks = $request->call();

            foreach ($jwks['keys'] as $key) { 
                $secret[$key['kid']] = $this->convertCertToPem($key['x5c'][0]);
            }

            $this->cache->set($url, $secret);
        }

        return $secret;
    }
}