<?php
namespace Auth0\Tests\Helpers;

use Cache\Adapter\PHPArray\ArrayCachePool;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class JWKFetcherTest.
 *
 * @package Auth0\Tests\Helpers\Cache
 */
class JWKFetcherTest extends TestCase
{

    public function testThatGetFormattedReturnsKeys()
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

    public function testThatGetFormattedEmptyJwksReturnsEmptyArray()
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

    public function testThatGetFormattedUsesCache()
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
}
