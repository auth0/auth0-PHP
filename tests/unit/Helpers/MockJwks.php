<?php
namespace Auth0\Tests\unit\Helpers;

use Auth0\SDK\Helpers\JWKFetcher;
use Auth0\Tests\unit\MockApi;
use Psr\SimpleCache\CacheInterface;


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
        $cache = isset( $config['cache'] ) && $config['cache'] instanceof CacheInterface ? $config['cache'] : null;
        $this->client = new JWKFetcher( $cache, $guzzleOptions );
    }
}
