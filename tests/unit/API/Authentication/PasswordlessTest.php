<?php

declare(strict_types=1);

namespace Auth0\Tests\unit\API\Authentication;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\Tests\API\ApiTests;
use Auth0\Tests\Traits\ErrorHelpers;
use GuzzleHttp\Psr7\Response;

/**
 * Class PasswordlessTest
 * Tests the Authentication API class, specifically passwordless grants.
 */
class PasswordlessTest extends ApiTests
{
    use ErrorHelpers;

    /**
     * Expected telemetry value.
     */
    protected static string $expectedTelemetry;

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $infoHeadersData = new InformationHeaders();
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    /**
     * Test That Email Passwordless Request Is Correct.
     */
    public function testThatEmailPasswordlessRequestIsCorrect(): void
    {
        $api = new MockAuthenticationApi(
            [
                new Response(200, ['Content-Type' => 'application/json'], '{}'),
            ]
        );

        $api->call()->emailPasswordlessStart('__test_email__', '__test_type__', ['__test_key__' => '__test_value__']);

        $this->assertEquals('https://test-domain.auth0.com/passwordless/start', $api->getHistoryUrl());

        $request_headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $request_headers['Content-Type'][0]);

        $request_body = $api->getHistoryBody();

        $this->assertCount(6, $request_body);

        $this->assertArrayHasKey('email', $request_body);
        $this->assertEquals('__test_email__', $request_body['email']);

        $this->assertArrayHasKey('send', $request_body);
        $this->assertEquals('__test_type__', $request_body['send']);

        $this->assertArrayHasKey('connection', $request_body);
        $this->assertEquals('email', $request_body['connection']);

        $this->assertArrayHasKey('client_id', $request_body);
        $this->assertEquals('__test_client_id__', $request_body['client_id']);

        $this->assertArrayHasKey('client_secret', $request_body);
        $this->assertEquals('__test_client_secret__', $request_body['client_secret']);

        $this->assertArrayHasKey('authParams', $request_body);
        $this->assertArrayHasKey('__test_key__', $request_body['authParams']);
        $this->assertEquals('__test_value__', $request_body['authParams']['__test_key__']);
    }

    /**
     * Test That Default Sms Passwordless Request Is Correct.
     */
    public function testThatDefaultSmsPasswordlessRequestIsCorrect(): void
    {
        $api = new MockAuthenticationApi(
            [
                new Response(200, ['Content-Type' => 'application/json'], '{}'),
            ]
        );

        $api->call()->smsPasswordlessStart('__test_number__');

        $this->assertEquals('https://test-domain.auth0.com/passwordless/start', $api->getHistoryUrl());

        $request_headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $request_headers['Content-Type'][0]);

        $request_body = $api->getHistoryBody();

        $this->assertCount(4, $request_body);

        $this->assertArrayHasKey('phone_number', $request_body);
        $this->assertEquals('__test_number__', $request_body['phone_number']);

        $this->assertArrayHasKey('connection', $request_body);
        $this->assertEquals('sms', $request_body['connection']);

        $this->assertArrayHasKey('client_id', $request_body);
        $this->assertEquals('__test_client_id__', $request_body['client_id']);

        $this->assertArrayHasKey('client_secret', $request_body);
        $this->assertEquals('__test_client_secret__', $request_body['client_secret']);
    }
}
