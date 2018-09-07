<?php
namespace Auth0\Tests\Helpers\Cache;

use \Auth0\SDK\Helpers\JWKFetcher;

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
    public function testFetchKeysWithoutKid()
    {
        $jwksFetcher = $this->getStub();

        $keys = $jwksFetcher->fetchKeys( 'https://localhost/' );

        $this->assertCount(1, $keys);

        $pem_parts = $this->getPemParts( $keys );

        $this->assertEquals( 4, count($pem_parts) );
        $this->assertEquals( '-----BEGIN CERTIFICATE-----', $pem_parts[0] );
        $this->assertEquals( '-----END CERTIFICATE-----', $pem_parts[2] );
        $this->assertEquals( '__test_x5c_1__', $pem_parts[1] );
    }

    /**
     * Test that a standard JWKS path returns the correct x5c when given a kid.
     *
     * @return void
     */
    public function testFetchKeysWithKid()
    {
        $jwksFetcher = $this->getStub();

        $keys = $jwksFetcher->fetchKeys( 'https://localhost/', '__test_kid_2__' );

        $this->assertCount(1, $keys);

        $pem_parts = $this->getPemParts( $keys );

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
    public function testFetchKeysWithPath()
    {
        $jwksFetcher = $this->getStub();

        $keys = $jwksFetcher->fetchKeys( 'https://localhost/', '__test_custom_kid__', '.custom/jwks.json' );

        $this->assertCount(1, $keys);

        $pem_parts = $this->getPemParts( $keys );

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
    public function testFetchKeysNoX5c()
    {
        $jwksFetcher = $this->getStub();

        $keys = $jwksFetcher->fetchKeys( 'https://localhost/', '__no_x5c_test_kid_2__' );

        $this->assertEmpty($keys);
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

    /**
     * Test that the protected getProp method returns correctly.
     *
     * @return void
     */
    public function testGetProp()
    {
        $jwks = $this->getLocalJwks( 'test', '-jwks' );

        $jwksFetcher = new JWKFetcher();

        $this->assertEquals( '__string_value_1__', $jwksFetcher->getProp( $jwks, 'string' ) );
        $this->assertEquals( '__array_value_1__', $jwksFetcher->getProp( $jwks, 'array' ) );
        $this->assertNull( $jwksFetcher->getProp( $jwks, 'invalid' ) );

        $test_kid = '__kid_value__';

        $this->assertEquals( '__string_value_2__', $jwksFetcher->getProp( $jwks, 'string', $test_kid ) );
        $this->assertEquals( '__array_value_3__', $jwksFetcher->getProp( $jwks, 'array', $test_kid ) );
        $this->assertNull( $jwksFetcher->getProp( $jwks, 'invalid', $test_kid ) );
    }

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
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getStub()
    {
        $stub = $this->getMockBuilder(JWKFetcher::class)
            ->setMethods(['getJwks'])
            ->getMock();

        $stub->method('getJwks')
            ->will($this->returnCallback([$this, 'getLocalJwks']));

        return $stub;
    }

    /**
     * Get array of PEM parts.
     *
     * @param array $keys JWKS keys.
     *
     * @return array
     */
    private function getPemParts(array $keys)
    {
        $keys_keys = array_keys($keys);
        $kid       = $keys_keys[0];
        $pem       = $keys[$kid];
        return explode( PHP_EOL, $pem );
    }
}
