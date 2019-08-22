<?php
namespace Auth0\Tests\Helpers;

use \Auth0\SDK\Helpers\JWKFetcher;
use \Auth0\SDK\Helpers\Cache\CacheHandler;

/**
 * Class JWKFetcherTest.
 *
 * @package Auth0\Tests\Helpers\Cache
 */
class JWKFetcherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that a standard JWKS path returns the first x5c.
     *
     * @return void
     */
    public function testGetJwksX5cWithoutKid()
    {
        $jwksFetcher = $this->getStub();

        $pem = $jwksFetcher->requestJwkX5c( 'https://localhost/.well-known/jwks.json' );

        $this->assertNotEmpty($pem);

        $pem_parts = explode( PHP_EOL, $pem );

        $this->assertEquals( 4, count($pem_parts) );
        $this->assertEquals( '-----BEGIN CERTIFICATE-----', $pem_parts[0] );
        $this->assertEquals( '-----END CERTIFICATE-----', $pem_parts[2] );
        $this->assertEquals( '__test_x5c_1__', $pem_parts[1] );
    }
    /**
     * Test that a standard JWKS path returns the first x5c.
     *
     * @return void
     */
    public function testGetCompleteJwks()
    {
        $jwksFetcher = $this->getStub();

        $jwks = $jwksFetcher->requestCompleteJwks( 'https://localhost/.well-known/jwks.json' );

        $this->assertNotEmpty($jwks);
        $this->assertCount(2, $jwks);

        $this->assertArrayHasKey( '__test_kid_1__', $jwks );
        $this->assertArrayHasKey( '__test_kid_2__', $jwks );

        $pem_1 = explode( PHP_EOL, $jwks['__test_kid_1__'] );

        $this->assertEquals( 4, count($pem_1) );
        $this->assertEquals( '-----BEGIN CERTIFICATE-----', $pem_1[0] );
        $this->assertEquals( '__test_x5c_1__', $pem_1[1] );
        $this->assertEquals( '-----END CERTIFICATE-----', $pem_1[2] );

        $pem_2 = explode( PHP_EOL, $jwks['__test_kid_2__'] );

        $this->assertEquals( 4, count($pem_2) );
        $this->assertEquals( '-----BEGIN CERTIFICATE-----', $pem_2[0] );
        $this->assertEquals( '__test_x5c_2__', $pem_2[1] );
        $this->assertEquals( '-----END CERTIFICATE-----', $pem_2[2] );
    }

    /**
     * Test that a standard JWKS path returns the correct x5c when given a kid.
     *
     * @return void
     */
    public function testGetJwksX5cWithKid()
    {
        $jwksFetcher = $this->getStub();

        $pem = $jwksFetcher->requestJwkX5c( 'https://localhost/.well-known/jwks.json', '__test_kid_2__' );

        $this->assertNotEmpty($pem);

        $pem_parts = explode( PHP_EOL, $pem );

        $this->assertEquals( 4, count($pem_parts) );
        $this->assertEquals( '-----BEGIN CERTIFICATE-----', $pem_parts[0] );
        $this->assertEquals( '-----END CERTIFICATE-----', $pem_parts[2] );
        $this->assertEquals( '__test_x5c_2__', $pem_parts[1] );
    }

    /**
     * Test that a custom JWKS path returns the correct JSON.
     *
     * @return void
     */
    public function testGetJwksX5cWithPath()
    {
        $jwksFetcher = $this->getStub();

        $pem = $jwksFetcher->requestJwkX5c( 'https://localhost/.custom/jwks.json', '__test_custom_kid__' );

        $this->assertNotEmpty($pem);

        $pem_parts = explode( PHP_EOL, $pem );

        $this->assertEquals( 4, count( $pem_parts ) );
        $this->assertEquals( '-----BEGIN CERTIFICATE-----', $pem_parts[0] );
        $this->assertEquals( '-----END CERTIFICATE-----', $pem_parts[2] );
        $this->assertEquals( '__test_custom_x5c__', $pem_parts[1] );
    }

    /**
     * Test that a JWK with no x509 cert returns a blank array.
     *
     * @return void
     */
    public function testGetJwksX5cNoX5c()
    {
        $jwksFetcher = $this->getStub();

        $pem = $jwksFetcher->requestJwkX5c( 'https://localhost/.custom/jwks.json', '__no_x5c_test_kid_2__' );

        $this->assertEmpty($pem);
    }

    /**
     * Test that the protected getProp method returns correctly.
     *
     * @return void
     */
    public function testConvertCertToPem()
    {
        $class  = new \ReflectionClass(JWKFetcher::class);
        $method = $class->getMethod('convertCertToPem');
        $method->setAccessible(true);

        $test_string_1 = '';
        for ($i = 1; $i <= 64; $i++) {
            $test_string_1 .= 'a';
        }

        $test_string_2 = '';
        for ($i = 1; $i <= 64; $i++) {
            $test_string_2 .= 'b';
        }

        $returned_pem = $method->invoke(new JWKFetcher(), $test_string_1.$test_string_2);
        $pem_parts    = explode( PHP_EOL, $returned_pem );
        $this->assertEquals( 5, count($pem_parts) );
        $this->assertEquals( '-----BEGIN CERTIFICATE-----', $pem_parts[0] );
        $this->assertEquals( $test_string_1, $pem_parts[1] );
        $this->assertEquals( $test_string_2, $pem_parts[2] );
        $this->assertEquals( '-----END CERTIFICATE-----', $pem_parts[3] );
    }

    public function testThatRequestJwkX5cWillGetFromCache()
    {
        $jwks_url    = 'https://localhost/.well-known/jwks.json';
        $kid         = '__test_kid_2__';
        $cache_value = '__cached_value__';
        $set_spy     = $this->once();
        $get_spy     = $this->any();

        // Mock the CacheHandler interface.
        $cache_handler = $this->getMockBuilder(CacheHandler::class)
            ->getMock();

        // The set method should only be called once.
        $cache_handler->expects($set_spy)
            ->method('set')
            ->willReturn( null );

        // The get method should be called once and return no cache first, then a cache value after.
        $cache_handler->expects($get_spy)
            ->method('get')
            ->will( $this->onConsecutiveCalls( null, $cache_value ) );

        $jwksFetcher = $this->getStub($cache_handler);

        $pem_not_cached = $jwksFetcher->requestJwkX5c( $jwks_url, $kid );
        $this->assertNotEmpty( $pem_not_cached );

        $pem_cached = $jwksFetcher->requestJwkX5c( $jwks_url, $kid );
        $this->assertEquals( $cache_value, $pem_cached );

        // Test that the set method was called with the correct parameters.
        $set_invocations = $set_spy->getInvocations();
        $this->assertEquals( $jwks_url.'|'.$kid, $set_invocations[0]->parameters[0] );
        $this->assertEquals( $pem_not_cached, $set_invocations[0]->parameters[1] );

        // Test that the get method was only called twice.
        $this->assertEquals( 2, $get_spy->getInvocationCount() );
    }

    public function testThatRequestCompleteJwksWillGetFromCache()
    {
        $jwks_url    = 'https://localhost/.well-known/jwks.json';
        $cache_value = '__cached_value__';
        $set_spy     = $this->once();
        $get_spy     = $this->any();

        // Mock the CacheHandler interface.
        $cache_handler = $this->getMockBuilder(CacheHandler::class)
            ->getMock();

        // The set method should only be called once.
        $cache_handler->expects($set_spy)
            ->method('set')
            ->willReturn( null );

        // The get method should be called once and return no cache first, then a cache value after.
        $cache_handler->expects($get_spy)
            ->method('get')
            ->will( $this->onConsecutiveCalls( null, $cache_value ) );

        $jwksFetcher = $this->getStub($cache_handler);

        $pem_not_cached = $jwksFetcher->requestCompleteJwks( $jwks_url );
        $this->assertNotEmpty( $pem_not_cached );

        $pem_cached = $jwksFetcher->requestCompleteJwks( $jwks_url );
        $this->assertEquals( $cache_value, $pem_cached );

        // Test that the set method was called with the correct parameters.
        $set_invocations = $set_spy->getInvocations();
        $this->assertEquals( $jwks_url, $set_invocations[0]->parameters[0] );
        $this->assertEquals( $pem_not_cached, $set_invocations[0]->parameters[1] );

        // Test that the get method was only called twice.
        $this->assertEquals( 2, $get_spy->getInvocationCount() );
    }

    /*
     *
     * Test helper functions.
     *
     */

    /**
     * Get a test JSON fixture instead of a remote one.
     *
     * @param string $domain Domain name of the JWKS.
     * @param string $path   Path to the JWKS.
     *
     * @return array
     */
    public function getLocalJwks($domain = '', $path = '')
    {
        // Normalize the domain to a file name.
        $domain = str_replace( 'https://', '', $domain );
        $domain = str_replace( 'http://', '', $domain );

        // Replace everything that isn't a letter, digit, or dash.
        $pattern     = '/[^a-zA-Z1-9^-]/i';
        $file_append = preg_replace($pattern, '-', $domain).preg_replace($pattern, '-', $path);

        // Get the test JSON file.
        $json_contents = file_get_contents( AUTH0_PHP_TEST_JSON_DIR.$file_append.'.json' );
        return json_decode( $json_contents, true );
    }

    /**
     * Stub the JWKFetcher class.
     *
     * @param CacheHandler|null $cache_handler Cache handler to use or null if no cache.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getStub($cache_handler = null)
    {
        $stub = $this->getMockBuilder(JWKFetcher::class)
            ->setConstructorArgs([$cache_handler])
            ->setMethods(['requestJwks'])
            ->getMock();

        $stub->method('requestJwks')
            ->will($this->returnCallback([$this, 'getLocalJwks']));

        return $stub;
    }
}
