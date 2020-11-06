<?php

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;


class TicketsTest extends ApiTests
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
        $infoHeadersData               = new InformationHeaders;
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    public function testThatSendVerificationEmailTicketRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->tickets()->createEmailVerificationTicket( '__test_user_id__', '__test_result_url__', [
            'identity' => [
                'user_id' => '__test_secondary_user_id__',
                'provider' => '__test_provider__'
            ]
        ] );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/tickets/email-verification', $api->getHistoryUrl() );
        $this->assertEmpty( $api->getHistoryQuery() );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'user_id', $body );
        $this->assertEquals( '__test_user_id__', $body['user_id'] );
        $this->assertArrayHasKey( 'result_url', $body );
        $this->assertEquals( '__test_result_url__', $body['result_url'] );
        $this->assertArrayHasKey( 'identity', $body);
        $this->assertEquals( [
            'user_id' => '__test_secondary_user_id__',
            'provider' => '__test_provider__'
        ], $body['identity']);

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
    }

    public function testThatPasswordChangeTicketRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->tickets()->createPasswordChangeTicket( '__test_user_id__', '__test_password__', '__test_result_url__', '__test_connection_id__', 8675309 );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/tickets/password-change', $api->getHistoryUrl() );
        $this->assertEmpty( $api->getHistoryQuery() );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'user_id', $body );
        $this->assertEquals( '__test_user_id__', $body['user_id'] );
        $this->assertArrayHasKey( 'new_password', $body );
        $this->assertEquals( '__test_password__', $body['new_password'] );
        $this->assertArrayHasKey( 'result_url', $body );
        $this->assertEquals( '__test_result_url__', $body['result_url'] );
        $this->assertArrayHasKey( 'connection_id', $body );
        $this->assertEquals( '__test_connection_id__', $body['connection_id'] );
        $this->assertArrayHasKey( 'ttl_sec', $body );
        $this->assertEquals( 8675309, $body['ttl_sec'] );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
    }

    public function testIdentityParamRequiresUserId()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );
        $exception_message = '';

        try {
            $api->call()->tickets()->createEmailVerificationTicket( '__test_user_id__', null, [
                'identity' => [
                    'provider' => '__test_provider__'
                ]
            ] );
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertStringContainsString( 'Missing required "user_id" field of the "identity" object.', $exception_message );
    }

    public function testIdentityParamRequiresUserIdAsString()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );
        $exception_message = '';

        try {
            $api->call()->tickets()->createEmailVerificationTicket( '__test_user_id__', null, [
                'identity' => [
                    'user_id' => 42,
                    'provider' => '__test_provider__'
                ]
            ] );
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertStringContainsString( 'Missing required "user_id" field of the "identity" object.', $exception_message );
    }

    public function testIdentityParamRequiresProvider()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );
        $exception_message = '';

        try {
            $api->call()->tickets()->createEmailVerificationTicket( '__test_user_id__', null, [
                'identity' => [
                    'user_id' => '__test_secondary_user_id__'
                ]
            ] );
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertStringContainsString( 'Missing required "provider" field of the "identity" object.', $exception_message );
    }

    public function testIdentityParamRequiresProviderAsString()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );
        $exception_message = '';

        try {
            $api->call()->tickets()->createEmailVerificationTicket( '__test_user_id__', null, [
                'identity' => [
                    'user_id' => '__test_secondary_user_id__',
                    'provider' => 42
                ]
            ] );
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertStringContainsString( 'Missing required "provider" field of the "identity" object.', $exception_message );
    }
}
