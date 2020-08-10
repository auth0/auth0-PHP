<?php
namespace Auth0\Tests\unit\API\Authentication;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\Exception\ApiException;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

/**
 * Class RefreshTokenTest.
 * Tests the \Auth0\SDK\API\Authentication::refresh_token() method.
 *
 * @package Auth0\Tests\unit\API\Authentication
 */
class RefreshTokenTest extends ApiTests
{

    /**
     * Expected telemetry value.
     *
     * @var string
     */
    protected static $expectedTelemetry;

    /**
     * Default request headers.
     *
     * @var array
     */
    protected static $headers = [ 'content-type' => 'json' ];

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass()
    {
        $infoHeadersData = new InformationHeaders;
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    /**
     * Test that an empty refresh token will throw an exception.
     */
    public function testThatRefreshTokenIsRequired()
    {
        $api = new Authentication('test_domain', 'test_client_id', 'test_client_secret');

        try {
            $api->refresh_token( '' );
            $caught_exception = false;
        } catch (ApiException $e) {
            $caught_exception = $this->errorHasString( $e, 'Refresh token cannot be blank' );
        }

        $this->assertTrue( $caught_exception );
    }

    /**
     * Test that setting an empty client_secret will override the default and throw an exception.
     */
    public function testThatClientSecretIsRequired()
    {
        $api = new Authentication('test_domain', 'test_client_id', 'test_client_secret');

        try {
            $api->refresh_token( uniqid(), [ 'client_secret' => '' ] );
            $caught_exception = false;
        } catch (ApiException $e) {
            $caught_exception = $this->errorHasString( $e, 'client_secret is mandatory' );
        }

        $this->assertTrue( $caught_exception );
    }

    /**
     * Test that setting an empty client_id will override the default and throw an exception.
     */
    public function testThatClientIdIsRequired()
    {
        $api = new Authentication('test_domain', 'test_client_id', 'test_client_secret');

        try {
            $api->refresh_token( uniqid(), [ 'client_id' => '' ] );
            $caught_exception = false;
        } catch (ApiException $e) {
            $caught_exception = $this->errorHasString( $e, 'client_id is mandatory' );
        }

        $this->assertTrue( $caught_exception );
    }

    /**
     * Test that the refresh token request is made successfully.
     *
     * @throws ApiException
     */
    public function testThatRefreshTokenRequestIsMadeCorrectly()
    {
        $api = new MockAuthenticationApi( [
            new Response( 200, [ 'Content-Type' => 'application/json' ], '{}' )
        ] );

        $refresh_token = uniqid();
        $api->call()->refresh_token( $refresh_token );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://test-domain.auth0.com/oauth/token', $api->getHistoryUrl() );
        $this->assertEmpty( $api->getHistoryQuery() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $request_body = $api->getHistoryBody();
        $this->assertEquals( 'refresh_token', $request_body['grant_type'] );
        $this->assertEquals( '__test_client_id__', $request_body['client_id'] );
        $this->assertEquals( '__test_client_secret__', $request_body['client_secret'] );
        $this->assertEquals( $refresh_token, $request_body['refresh_token'] );
    }
}
