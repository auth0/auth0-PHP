<?php

namespace Auth0\SDK\Helpers;

use Auth0\SDK\Helpers\Cache\CacheHandler;
use Auth0\SDK\Helpers\Cache\NoCacheHandler;

class JWKFetcher {

    private $cache = null;

    public function __construct(CacheHandler $cache = null) {
        if ($cache === null) {
            $cache = new NoCacheHandler();
        }

        $this->cache = $cache;
    }

    protected function convertCertToPem($cert) {
        return '-----BEGIN CERTIFICATE-----'.PHP_EOL
            .chunk_split($cert, 64, PHP_EOL)
            .'-----END CERTIFICATE-----'.PHP_EOL;
    }

    public function fetchKeys($iss) {
        $secret = [];
        $url = "{$iss}.well-known/jwks.json";

        if ($secret = $this->cache->get($url) === null) {
            $jwks = json_decode(file_get_contents($url));
            foreach ($jwks->keys as $key) {
                $secret[$key->kid] = $this->convertCertToPem($key->x5c[0]);
            }

            $this->cache->set($url, $secret);
        }

        return $secret;
    }
}