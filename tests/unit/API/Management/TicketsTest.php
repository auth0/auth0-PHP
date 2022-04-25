<?php

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

use function PHPSTORM_META\map;

/**
 * @group failing
 */
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
    public static function setUpBeforeClass(): void
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

    public function testThatPasswordChangeTicketRawRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $data = [
            'user_id' => uniqid(),
            'email' => uniqid(),
            'new_password' => uniqid(),
            'result_url' => uniqid(),
            'connection_id' => uniqid(),
            'ttl_sec' => uniqid(),
            'client_id' => uniqid(),
            'organization_id' => uniqid(),
            'mark_email_as_verified' => true,
            'includeEmailInRedirect' => true
        ];

        $api->call()->tickets()->createPasswordChangeTicketRaw(
            $data['user_id'],
            $data['email'],
            $data['new_password'],
            $data['result_url'],
            $data['connection_id'],
            $data['ttl_sec'],
            $data['client_id'],
            $data['organization_id'],
            $data['mark_email_as_verified'],
            $data['includeEmailInRedirect'],
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/tickets/password-change', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());

        $body = $api->getHistoryBody();

        $this->assertArrayHasKey('user_id', $body);
        $this->assertArrayHasKey('email', $body);
        $this->assertArrayHasKey('new_password', $body);
        $this->assertArrayHasKey('connection_id', $body);
        $this->assertArrayHasKey('ttl_sec', $body);
        $this->assertArrayHasKey('client_id', $body);
        $this->assertArrayHasKey('organization_id', $body);
        $this->assertArrayHasKey('mark_email_as_verified', $body);
        $this->assertArrayHasKey('includeEmailInRedirect', $body);

        $this->assertEquals($data['user_id'], $body['user_id']);
        $this->assertEquals($data['email'], $body['email']);
        $this->assertEquals($data['new_password'], $body['new_password']);
        $this->assertEquals($data['connection_id'], $body['connection_id']);
        $this->assertEquals($data['ttl_sec'], $body['ttl_sec']);
        $this->assertEquals($data['client_id'], $body['client_id']);
        $this->assertEquals($data['organization_id'], $body['organization_id']);
        $this->assertEquals($data['mark_email_as_verified'], $body['mark_email_as_verified']);
        $this->assertEquals($data['includeEmailInRedirect'], $body['includeEmailInRedirect']);

        $headers = $api->getHistoryHeaders();

        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
    }

    public function testThatPasswordChangeTicketRawIgnoresInvalidMarkEmailAsVerifiedParam()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $data = [
            'user_id' => uniqid(),
            'email' => uniqid(),
            'new_password' => uniqid(),
            'result_url' => uniqid(),
            'connection_id' => uniqid(),
            'ttl_sec' => uniqid(),
            'client_id' => uniqid(),
            'organization_id' => uniqid(),
            'mark_email_as_verified' => uniqid(),
            'includeEmailInRedirect' => true
        ];

        $api->call()->tickets()->createPasswordChangeTicketRaw(
            $data['user_id'],
            $data['email'],
            $data['new_password'],
            $data['result_url'],
            $data['connection_id'],
            $data['ttl_sec'],
            $data['client_id'],
            $data['organization_id'],
            $data['mark_email_as_verified'],
            $data['includeEmailInRedirect'],
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/tickets/password-change', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());

        $body = $api->getHistoryBody();

        $this->assertArrayNotHasKey('mark_email_as_verified', $body);
    }

    public function testThatPasswordChangeTicketRawIgnoresInvalidIncludeEmailInRedirectParam()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $data = [
            'user_id' => uniqid(),
            'email' => uniqid(),
            'new_password' => uniqid(),
            'result_url' => uniqid(),
            'connection_id' => uniqid(),
            'ttl_sec' => uniqid(),
            'client_id' => uniqid(),
            'organization_id' => uniqid(),
            'mark_email_as_verified' => true,
            'includeEmailInRedirect' => uniqid()
        ];

        $api->call()->tickets()->createPasswordChangeTicketRaw(
            $data['user_id'],
            $data['email'],
            $data['new_password'],
            $data['result_url'],
            $data['connection_id'],
            $data['ttl_sec'],
            $data['client_id'],
            $data['organization_id'],
            $data['mark_email_as_verified'],
            $data['includeEmailInRedirect'],
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/tickets/password-change', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());

        $body = $api->getHistoryBody();

        $this->assertArrayNotHasKey('includeEmailInRedirect', $body);
    }

    public function testThatPasswordChangeTicketRawTreatsFalseBooleansCorrectly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $data = [
            'user_id' => uniqid(),
            'email' => uniqid(),
            'new_password' => uniqid(),
            'result_url' => uniqid(),
            'connection_id' => uniqid(),
            'ttl_sec' => uniqid(),
            'client_id' => uniqid(),
            'organization_id' => uniqid(),
            'mark_email_as_verified' => false,
            'includeEmailInRedirect' => false
        ];

        $api->call()->tickets()->createPasswordChangeTicketRaw(
            $data['user_id'],
            $data['email'],
            $data['new_password'],
            $data['result_url'],
            $data['connection_id'],
            $data['ttl_sec'],
            $data['client_id'],
            $data['organization_id'],
            $data['mark_email_as_verified'],
            $data['includeEmailInRedirect'],
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/tickets/password-change', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());

        $body = $api->getHistoryBody();

        $this->assertArrayHasKey('mark_email_as_verified', $body);
        $this->assertArrayHasKey('includeEmailInRedirect', $body);

        $this->assertEquals($data['mark_email_as_verified'], $body['mark_email_as_verified']);
        $this->assertEquals($data['includeEmailInRedirect'], $body['includeEmailInRedirect']);
    }

    public function testThatPasswordChangeTicketByEmailRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $data = [
            'email' => uniqid(),
            'new_password' => uniqid(),
            'result_url' => uniqid(),
            'connection_id' => uniqid(),
            'ttl_sec' => uniqid(),
            'client_id' => uniqid(),
            'organization_id' => uniqid(),
            'mark_email_as_verified' => true,
            'includeEmailInRedirect' => true
        ];

        $api->call()->tickets()->createPasswordChangeTicketByEmail(
            $data['email'],
            $data['new_password'],
            $data['result_url'],
            $data['connection_id'],
            $data['ttl_sec'],
            $data['client_id'],
            $data['organization_id'],
            $data['mark_email_as_verified'],
            $data['includeEmailInRedirect'],
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/tickets/password-change', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());

        $body = $api->getHistoryBody();

        $this->assertArrayNotHasKey('user_id', $body);
        $this->assertArrayHasKey('email', $body);
        $this->assertArrayHasKey('new_password', $body);
        $this->assertArrayHasKey('connection_id', $body);
        $this->assertArrayHasKey('ttl_sec', $body);
        $this->assertArrayHasKey('client_id', $body);
        $this->assertArrayHasKey('organization_id', $body);
        $this->assertArrayHasKey('mark_email_as_verified', $body);
        $this->assertArrayHasKey('includeEmailInRedirect', $body);

        $this->assertEquals($data['email'], $body['email']);
        $this->assertEquals($data['new_password'], $body['new_password']);
        $this->assertEquals($data['connection_id'], $body['connection_id']);
        $this->assertEquals($data['ttl_sec'], $body['ttl_sec']);
        $this->assertEquals($data['client_id'], $body['client_id']);
        $this->assertEquals($data['organization_id'], $body['organization_id']);
        $this->assertEquals($data['mark_email_as_verified'], $body['mark_email_as_verified']);
        $this->assertEquals($data['includeEmailInRedirect'], $body['includeEmailInRedirect']);

        $headers = $api->getHistoryHeaders();

        $this->assertEquals('Bearer __api_token__', $headers['Authorization'][0]);
        $this->assertEquals(self::$expectedTelemetry, $headers['Auth0-Client'][0]);
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }

    public function testThatPasswordChangeTicketRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $data = [
            'user_id' => uniqid(),
            'new_password' => uniqid(),
            'result_url' => uniqid(),
            'connection_id' => uniqid(),
            'ttl_sec' => uniqid(),
            'client_id' => uniqid(),
            'organization_id' => uniqid(),
            'mark_email_as_verified' => true,
            'includeEmailInRedirect' => true
        ];

        $api->call()->tickets()->createPasswordChangeTicket(
            $data['user_id'],
            $data['new_password'],
            $data['result_url'],
            $data['connection_id'],
            $data['ttl_sec'],
            $data['client_id'],
            $data['organization_id'],
            $data['mark_email_as_verified'],
            $data['includeEmailInRedirect'],
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/tickets/password-change', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());

        $body = $api->getHistoryBody();

        $this->assertArrayHasKey('user_id', $body);
        $this->assertArrayNotHasKey('email', $body);
        $this->assertArrayHasKey('new_password', $body);
        $this->assertArrayHasKey('connection_id', $body);
        $this->assertArrayHasKey('ttl_sec', $body);
        $this->assertArrayHasKey('client_id', $body);
        $this->assertArrayHasKey('organization_id', $body);
        $this->assertArrayHasKey('mark_email_as_verified', $body);
        $this->assertArrayHasKey('includeEmailInRedirect', $body);

        $this->assertEquals($data['user_id'], $body['user_id']);
        $this->assertEquals($data['new_password'], $body['new_password']);
        $this->assertEquals($data['connection_id'], $body['connection_id']);
        $this->assertEquals($data['ttl_sec'], $body['ttl_sec']);
        $this->assertEquals($data['client_id'], $body['client_id']);
        $this->assertEquals($data['organization_id'], $body['organization_id']);
        $this->assertEquals($data['mark_email_as_verified'], $body['mark_email_as_verified']);
        $this->assertEquals($data['includeEmailInRedirect'], $body['includeEmailInRedirect']);

        $headers = $api->getHistoryHeaders();

        $this->assertEquals('Bearer __api_token__', $headers['Authorization'][0]);
        $this->assertEquals(self::$expectedTelemetry, $headers['Auth0-Client'][0]);
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }
}
