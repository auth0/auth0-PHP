<?php
namespace Auth0\Tests\Helpers;

use Auth0\SDK\Helpers\Cache\CacheHandler;
use Auth0\SDK\Helpers\JWKFetcher;
use Auth0\Tests\MockApi;


/**
 * Class MockJwks
 *
 * @package Auth0\SDK\Helpers\JWKFetcher
 */
class MockJwks extends MockApi
{

    /**
     * @var JWKFetcher
     */
    protected $client;

    /**
     * @param array $guzzleOptions
     * @param array $config
     */
    public function setClient(array $guzzleOptions, array $config = [])
    {
        $cache        = isset( $config['cache'] ) && $config['cache'] instanceof CacheHandler ? $config['cache'] : null;
        $this->client = new JWKFetcher( $cache, $guzzleOptions );
    }
}
