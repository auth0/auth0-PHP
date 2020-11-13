<?php
namespace Auth0\Tests\unit\Helpers;

use Auth0\SDK\Helpers\JWKFetcher;
use Cache\Adapter\PHPArray\ArrayCachePool;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Auth0\SDK\Exception\CoreException;

/**
 * Class JWKFetcherTest.
 *
 * @package Auth0\Tests\unit\Helpers\Cache
 */
class JWKFetcherTest extends TestCase
{

    public function testThatGetKeysReturnsKeys()
    {
        $test_jwks = file_get_contents( AUTH0_PHP_TEST_JSON_DIR.'localhost--well-known-jwks-json.json' );
        $jwks      = new MockJwks( [ new Response( 200, [ 'Content-Type' => 'application/json' ], $test_jwks ) ] );

        $jwks_formatted = $jwks->call()->getKeys( uniqid() );

        $this->assertCount( 2, $jwks_formatted );
        $this->assertArrayHasKey( '__test_kid_1__', $jwks_formatted );

        $pem_parts_1 = explode( PHP_EOL, $jwks_formatted['__test_kid_1__'] );
        $this->assertCount( 4, $pem_parts_1 );
        $this->assertEquals( '-----BEGIN CERTIFICATE-----', $pem_parts_1[0] );
        $this->assertEquals( '__test_x5c_1__', $pem_parts_1[1] );
        $this->assertEquals( '-----END CERTIFICATE-----', $pem_parts_1[2] );

        $pem_parts_2 = explode( PHP_EOL, $jwks_formatted['__test_kid_2__'] );
        $this->assertCount( 4, $pem_parts_2 );
        $this->assertEquals( '-----BEGIN CERTIFICATE-----', $pem_parts_2[0] );
        $this->assertEquals( '__test_x5c_2__', $pem_parts_2[1] );
        $this->assertEquals( '-----END CERTIFICATE-----', $pem_parts_2[2] );
    }

    public function testThatGetKeysEmptyJwksReturnsEmptyArray()
    {
        $jwks = new MockJwks( [
            new Response( 200, [ 'Content-Type' => 'application/json' ], '{}' ),
            new Response( 200, [ 'Content-Type' => 'application/json' ], '{"keys":[]}' ),
        ] );

        $jwks_formatted = $jwks->call()->getKeys( uniqid() );
        $this->assertEquals( [], $jwks_formatted );

        $jwks_formatted = $jwks->call()->getKeys( uniqid() );
        $this->assertEquals( [], $jwks_formatted );
    }

    public function testThatGetKeysUsesCache()
    {
        $jwks_body_1 = '{"keys":[{"kid":"abc","x5c":["123"]}]}';
        $jwks_body_2 = '{"keys":[{"kid":"def","x5c":["456"]}]}';
        $jwks        = new MockJwks(
            [
                new Response( 200, [ 'Content-Type' => 'application/json' ], $jwks_body_1 ),
                new Response( 200, [ 'Content-Type' => 'application/json' ], $jwks_body_2 ),
            ],
            [
                'cache' => new ArrayCachePool()
            ]
        );

        $jwks_formatted_1 = $jwks->call()->getKeys( '__test_url__' );
        $this->assertArrayHasKey( 'abc', $jwks_formatted_1 );
        $this->assertContains( '123', $jwks_formatted_1['abc'] );

        $jwks_formatted_2 = $jwks->call()->getKeys( '__test_url__' );
        $this->assertEquals( $jwks_formatted_1, $jwks_formatted_2 );

        $jwks_formatted_2 = $jwks->call()->getKeys( '__test_url_2__' );
        $this->assertArrayHasKey( 'def', $jwks_formatted_2 );
        $this->assertContains( '456', $jwks_formatted_2['def'] );
    }

    public function testThatGetKeyBreaksCache()
    {
        $jwks_body_1 = '{"keys":[{"kid":"__kid_1__","x5c":["__x5c_1__"]}]}';
        $jwks_body_2 = '{"keys":[{"kid":"__kid_1__","x5c":["__x5c_1__"]},{"kid":"__kid_2__","x5c":["__x5c_2__"]}]}';
        $jwks        = new MockJwks(
            [
                new Response( 200, [ 'Content-Type' => 'application/json' ], $jwks_body_1 ),
                new Response( 200, [ 'Content-Type' => 'application/json' ], $jwks_body_2 ),
            ],
            [
                'cache' => new ArrayCachePool()
            ]
        );

        $jwks_formatted_1 = $jwks->call()->getKeys( '__test_url__' );
        $this->assertArrayHasKey( '__kid_1__', $jwks_formatted_1 );
        $this->assertArrayNotHasKey( '__kid_2__', $jwks_formatted_1 );

        $jwks_formatted_2 = $jwks->call()->getKeys( '__test_url__' );
        $this->assertEquals( $jwks_formatted_1, $jwks_formatted_2 );

        $jwks_formatted_3 = $jwks->call()->getKeys( '__test_url__', false );
        $this->assertArrayHasKey( '__kid_1__', $jwks_formatted_3 );
        $this->assertArrayHasKey( '__kid_2__', $jwks_formatted_3 );
    }

    public function testThatGetKeysUsesOptionsUrl()
    {
        $jwks_body = '{"keys":[{"kid":"__kid_1__","x5c":["__x5c_1__"]}]}';
        $jwks = new MockJwks(
            [ new Response( 200, [ 'Content-Type' => 'application/json' ], $jwks_body ) ],
            [ 'cache' => new ArrayCachePool() ],
            [ 'base_uri' => '__test_jwks_url__' ]
        );

        $jwks->call()->getKeys();
        $this->assertEquals( '__test_jwks_url__', $jwks->getHistoryUrl() );
    }

    public function testThatGetKeyGetsSpecificKid() {
        $cache = new ArrayCachePool();
        $jwks = new JWKFetcher( $cache, [ 'base_uri' => '__test_jwks_url__' ] );
        $cache->set(md5('__test_jwks_url__'), ['__test_kid_1__' => '__test_x5c_1__']);
        $this->assertEquals('__test_x5c_1__', $jwks->getKey('__test_kid_1__'));
    }

    public function testThatGetKeyBreaksCacheIsKidMissing() {
        $cache = new ArrayCachePool();

        $jwks_body = '{"keys":[{"kid":"__test_kid_2__","x5c":["__test_x5c_2__"]}]}';
        $jwks = new MockJwks(
            [ new Response( 200, [ 'Content-Type' => 'application/json' ], $jwks_body ) ],
            [ 'cache' => $cache ],
            [ 'base_uri' => '__test_jwks_url__' ]
        );

        $cache->set(md5('__test_jwks_url__'), ['__test_kid_1__' => '__test_x5c_1__']);

        $this->assertContains('__test_x5c_2__', $jwks->call()->getKey('__test_kid_2__'));
    }

    public function testThatEmptyUrlReturnsEmptyKeys() {
        $jwks_formatted_1 = (new JWKFetcher())->getKeys();
        $this->assertEquals( [], $jwks_formatted_1 );
    }

    public function testThatTtlChanges() {
        $jwks_body = '{"keys":[{"kid":"__test_kid_2__","x5c":["__test_x5c_2__"]}]}';
        $jwks = new MockJwks(
            // [ new Response( 200, [ 'Content-Type' => 'application/json' ], $jwks_body ) ],
            // [ 'cache' => new ArrayCachePool() ],
            // [ 'base_uri' => '__test_jwks_url__' ]
        );

        // Ensure TTL is assigned a recommended default value of 10 minutes.
        $this->assertEquals(JWKFetcher::CACHE_TTL, $jwks->call()->getTtl());

        // Ensure TTL is assigned correctly; 60 seconds is the minimum.
        $jwks->call()->setTtl(60);
        $this->assertEquals(60, $jwks->call()->getTtl());

        // Ensure assigning a TTL of less than 60 seconds throws an exception.
        $this->expectException(CoreException::class);
        $jwks->call()->setTtl(30);
    }

    public function testThatCacheMutates() {
        $jwks_body = '{"keys":[{"kid":"__kid_1__","x5c":["__x5c_1__"]},{"kid":"__kid_2__","x5c":["__x5c_2__"]}]}';
        $jwks_body_modified = ['__kid_3__' => '__x5c_3__', '__kid_4__' => '__x5c_4__'];

        $jwks = new MockJwks(
            [
                new Response( 200, [ 'Content-Type' => 'application/json' ], $jwks_body ),
                new Response( 200, [ 'Content-Type' => 'application/json' ], $jwks_body ),
            ],
            [ 'cache' => new ArrayCachePool() ],
            [ 'base_uri' => '__test_jwks_url__' ]
        );

        $jwks->call()->getKeys('__test_jwks_url__', false);

        // getCacheKey MUST return an MD5 hash of provided JWKS URL.
        $this->assertEquals(md5('__test_jwks_url__'), $jwks->call()->getCacheKey('__test_jwks_url__'));

        // Requests for invalid/missing kids MUST return NULL.
        $this->assertEquals(null, $jwks->call()->getKey('__test_missing_kid__'));

        // Requesting a valid kid MUST return an ARRAY containing the x5c
        $this->assertContains('__x5c_1__', $jwks->call()->getKey('__kid_1__'));

        // Pulling directly from cache will return same results as getKeys()
        $this->assertArrayHasKey('__kid_1__', $jwks->call()->getCacheEntry('__test_jwks_url__'));

        // Overwrite an existing JWK in the cache.
        $jwks->call()->setCacheEntry('__test_jwks_url__', $jwks_body_modified);

        // Inject a new JWK into the cache.
        $jwks->call()->setCacheEntry('__test_jwks_url_2__', $jwks_body_modified);

        // Ensure the cache was updated successfully
        $this->assertArrayHasKey('__kid_3__', $jwks->call()->getCacheEntry('__test_jwks_url__'));

        // Purge the cache of keys relating to our test url
        $jwks->call()->removeCacheEntry('__test_jwks_url__');

        // Ensure cache for our test url is empty
        $this->assertEmpty($jwks->call()->getCacheEntry('__test_jwks_url__'));

        // Ensure the cache still contains content for __test_jwks_url_2__
        $this->assertArrayHasKey('__kid_3__', $jwks->call()->getCacheEntry('__test_jwks_url_2__'));

        // Purge the cache of all keys
        $jwks->call()->clearCache();

        // Ensure all JWKs are cleared from the cache.
        $this->assertEmpty($jwks->call()->getCacheEntry('__test_jwks_url__'));
        $this->assertEmpty($jwks->call()->getCacheEntry('__test_jwks_url_2__'));
    }
}
