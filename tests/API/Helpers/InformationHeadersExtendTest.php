<?php
namespace Auth0\Tests\Api\Helpers;

use Auth0\Tests\API\Management\MockManagementApi;
use Auth0\Tests\API\Authentication\MockAuthenticationApi;
use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\API\Helpers\ApiClient;
use GuzzleHttp\Psr7\Response;

/**
 * Class InformationHeadersExtendTest
 *
 * @package Auth0\Tests\Api\Helpers
 */
class InformationHeadersExtendTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Extend existing headers and make sure existing data stays intact.
     *
     * @link https://github.com/auth0/jwt-auth-bundle/blob/master/src/JWTAuthBundle.php
     * @link https://github.com/auth0/laravel-auth0/blob/master/src/Auth0/Login/LoginServiceProvider.php
     *
     * @return void
     */
    public function testThatExtendedHeadersBuildCorrectly()
    {
        $new_headers = self::setExtendedHeaders('test-extend-sdk-1', '1.2.3');
        $new_headers->setEnvironment('test-extend-env', '2.3.4');

        $new_header_data = $new_headers->get();

        // Look for new SDK name and version.
        $this->assertEquals( 'test-extend-sdk-1', $new_header_data['name'] );
        $this->assertEquals( '1.2.3', $new_header_data['version'] );

        // Look for original env data.
        $this->assertArrayHasKey('env', $new_header_data);
        $this->assertArrayHasKey('php', $new_header_data['env']);
        $this->assertEquals( phpversion(), $new_header_data['env']['php'] );
        $this->assertArrayHasKey('auth0-php', $new_header_data['env']);
        $this->assertEquals(ApiClient::API_VERSION, $new_header_data['env']['auth0-php']);

        // Look for extended env data.
        $this->assertArrayHasKey('test-extend-env', $new_header_data['env']);
        $this->assertEquals('2.3.4', $new_header_data['env']['test-extend-env']);
    }

    /**
     * Test that extending the headers works for Management API calls.
     *
     * @throws \Exception Unsuccessful HTTP call or empty mock history queue.
     */
    public function testThatExtendedHeadersAreUsedForManagementApiCalls()
    {
        $new_headers = self::setExtendedHeaders('test-extend-sdk-2', '2.3.4');

        $api = new MockManagementApi( [ new Response( 200 ) ] );
        $api->call()->connections->getAll();
        $headers = $api->getHistoryHeaders();

        $this->assertEquals( $new_headers->build(), $headers['Auth0-Client'][0] );
    }

    /**
     * Test that extending the headers works for Management API calls.
     *
     * @throws \Exception Unsuccessful HTTP call or empty mock history queue.
     */
    public function testThatExtendedHeadersAreUsedForAuthenticationApiCalls()
    {
        $new_headers = self::setExtendedHeaders('test-extend-sdk-3', '3.4.5');

        $api = new MockAuthenticationApi( [ new Response( 200 ) ] );
        $api->call()->oauth_token( [ 'grant_type' => uniqid() ] );
        $headers = $api->getHistoryHeaders();

        $this->assertEquals( $new_headers->build(), $headers['Auth0-Client'][0] );
    }

    /*
     * Test helper methods.
     */

    /**
     * Reset and extend telemetry headers.
     *
     * @param string $name New SDK name.
     * @param string $version New SDK version.
     *
     * @return InformationHeaders
     */
    public static function setExtendedHeaders($name, $version)
    {
        $reset_headers = new InformationHeaders;
        $reset_headers->setCorePackage();
        ApiClient::setInfoHeadersData($reset_headers);

        $headers     = ApiClient::getInfoHeadersData();
        $new_headers = InformationHeaders::Extend($headers);
        $new_headers->setPackage($name, $version);
        ApiClient::setInfoHeadersData($new_headers);
        return $new_headers;
    }
}
