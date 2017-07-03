<?php
namespace Auth0\Tests\Api\Helpers;

use Auth0\SDK\Helpers\JWKFetcher;
use Auth0\Tests\API\ApiTests;
use Auth0\Tests\CacheDecorator;
use Cache\Adapter\PHPArray\ArrayCachePool;
use Cache\Bridge\SimpleCache\SimpleCacheBridge;

class JWKTest extends ApiTests
{
    public function testNoCache() 
    {
      $env = $this->getEnv();
      $fetcher = new JWKFetcher();

      $keys = $fetcher->fetchKeys($env['DOMAIN']);
      $this->assertTrue(is_array($keys));

      $keys = $fetcher->fetchKeys($env['DOMAIN']);
      $this->assertTrue(is_array($keys));
    }

    public function testFileSystemCache() 
    {
      $env = $this->getEnv();
      $cache = new CacheDecorator(new SimpleCacheBridge(new ArrayCachePool()));
      $fetcher = new JWKFetcher($cache);

      $keys = $fetcher->fetchKeys($env['DOMAIN']);
      $this->assertTrue(is_array($keys));

      $keys = $fetcher->fetchKeys($env['DOMAIN']);
      $this->assertTrue(is_array($keys));

      $this->assertEquals(2, $cache->count('get'));
      $this->assertEquals(1, $cache->count('set'));
      $this->assertEquals(0, $cache->count('delete'));

      $cache->delete('auth0-php.auth0.com.well-known/jwks.json');

      $keys = $fetcher->fetchKeys($env['DOMAIN']);
      $this->assertTrue(is_array($keys));

      $this->assertEquals(3, $cache->count('get'));
      $this->assertEquals(2, $cache->count('set'));
      $this->assertEquals(1, $cache->count('delete'));
    }
}