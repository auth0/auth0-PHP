<?php

namespace Auth0\SDK\Helpers;

use Auth0\SDK\API\Helpers\HttpClientBuilder;
use Auth0\SDK\API\Helpers\ResponseMediator;
use Psr\SimpleCache\CacheInterface;

final class JWKFetcher
{
    /**
     * @var CacheInterface|null
     */
    private $cache = null;

    /**
     * JWKFetcher constructor.
     *
     * @param CacheInterface|null $cache
     */
    public function __construct(CacheInterface $cache = null)
    {
        $this->cache = $cache;
    }

    /**
     * @param string $cert
     *
     * @return string
     */
    private function convertCertToPem($cert)
    {
        return '-----BEGIN CERTIFICATE-----'.PHP_EOL
            .chunk_split($cert, 64, PHP_EOL)
            .'-----END CERTIFICATE-----'.PHP_EOL;
    }

    /**
     * @param string $iss
     *
     * @return array|null
     */
    public function fetchKeys($iss)
    {
        $url = "{$iss}.well-known/jwks.json";

        if (null === $this->cache || ($secret = $this->cache->get($url)) === null) {
            $secret = [];

            $httpClient = (new HttpClientBuilder($iss))->buildHttpClient();
            $response = $httpClient->get('.well-known/jwks.json');
            $jwks = ResponseMediator::getContent($response);

            foreach ($jwks['keys'] as $key) {
                $secret[$key['kid']] = $this->convertCertToPem($key['x5c'][0]);
            }

            if ($this->cache) {
                $this->cache->set($url, $secret);
            }
        }

        return $secret;
    }
}
