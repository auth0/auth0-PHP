<?php

namespace Auth0\Tests\Helpers;

use Auth0\SDK\Helpers\JWKFetcher;
use josegonzalez\Dotenv\Loader;
use GuzzleHttp\Exception\RequestException;

/**
 * Class JWKFetcherTest
 *
 * @package Auth0\SDK\Helpers
 */
class JWKFetcherTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Issuer for JWKS URL.
     *
     * @var string
     */
    public static $issuer;

    /**
     * Setup before class.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        $env_path = '.env';
        if (file_exists($env_path)) {
            $loader = new Loader($env_path);
            $loader->parse()->putenv(true);
        }

        self::$issuer = 'https://'.getenv('DOMAIN').'/';
        parent::setUpBeforeClass();
    }

    /**
     * Test that a valid JWKS is fetched.
     *
     * @return void
     */
    public function testFetchJwks()
    {
        $fetcher = new JWKFetcher();
        $keys    = $fetcher->fetchKeys( self::$issuer );

        $this->assertNotEmpty( $keys );

        $pem_parts = $this->getPemFromKeys( $keys );

        $this->assertEquals( '-----BEGIN CERTIFICATE-----', $pem_parts[0] );
        $this->assertEquals( '-----END CERTIFICATE-----', $pem_parts[count($pem_parts) - 2] );
    }

    /**
     * Test that a valid JWKS is fetched with an empty path passed.
     *
     * @return void
     */
    public function testFetchJwksFullUrl()
    {
        $fetcher = new JWKFetcher();
        $keys    = $fetcher->fetchKeys( self::$issuer.'.well-known/jwks.json', null );

        $this->assertNotEmpty( $keys );

        $pem_parts = $this->getPemFromKeys( $keys );

        $this->assertEquals( '-----BEGIN CERTIFICATE-----', $pem_parts[0] );
        $this->assertEquals( '-----END CERTIFICATE-----', $pem_parts[count($pem_parts) - 2] );
    }

    /**
     * Test that a custom JWKS URL results in a 404.
     *
     * @return void
     */
    public function testFetchJwksCustom()
    {
        $fetcher = new JWKFetcher();

        $caught_req_exception = false;
        try {
            $fetcher->fetchKeys( self::$issuer, 'invalid/jwks.json' );
        } catch (RequestException $e) {
            $caught_req_exception = true;
        }

        $this->assertTrue($caught_req_exception);
    }

    /**
     * Get a parsed PEM from a key array.
     *
     * @param array $keys Keys returned from \Auth0\SDK\Helpers\JWKFetcher::fetchKeys().
     *
     * @return array
     */
    private function getPemFromKeys(array $keys)
    {
        $kids = array_keys( $keys );
        $pem  = $keys[$kids[0]];
        return explode( PHP_EOL, $pem );

    }
}
