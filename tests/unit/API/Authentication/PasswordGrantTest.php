<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Authentication;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

/**
 * Class PasswordGrantTest
 * Tests the Authentication API class, specifically password grants.
 */
class PasswordGrantTest extends ApiTests
{
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
     * Test that password grant login enforcces username.
     */
    public function testThatPasswordGrantLoginEnforcesUsername(): void
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $this->expectException(\Auth0\SDK\Exception\ApiException::class);
        $this->expectExceptionMessage('username is mandatory');

        $api->loginWithDefaultDirectory([]);

        $this->expectException(\Auth0\SDK\Exception\ApiException::class);
        $this->expectExceptionMessage('username is mandatory');

        $api->login([]);
    }

    /**
     * Test that password grant login enforces password.
     */
    public function testThatPasswordGrantLoginEnforcesPassword(): void
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $this->expectException(\Auth0\SDK\Exception\ApiException::class);
        $this->expectExceptionMessage('password is mandatory');

        $api->loginWithDefaultDirectory(['username' => uniqid()]);

        $this->expectException(\Auth0\SDK\Exception\ApiException::class);
        $this->expectExceptionMessage('password is mandatory');

        $api->login(['username' => uniqid()]);
    }

    /**
     * Test that password grant realm logic enforces realm.
     */
    public function testThatPasswordGrantRealmLoginEnforcesRealm(): void
    {
        $api = new Authentication('test-domain.auth0.com', '__test_client_id__');

        $this->expectException(\Auth0\SDK\Exception\ApiException::class);
        $this->expectExceptionMessage('realm is mandatory');

        $api->login(['username' => uniqid(), 'password' => uniqid()]);
    }

    /**
     * Test that a basic password grant request includes the correct URL, body, and headers.
     */
    public function testThatPasswordGrantLoginSendsBasicRequestCorrectly(): void
    {
        $api = new MockAuthenticationApi(
            [
                new Response(200, ['Content-Type' => 'application/json'], '{}'),
            ]
        );

        $api->call()->loginWithDefaultDirectory(
            [
                'username' => 'the_username',
                'password' => 'the_password',
            ]
        );

        $this->assertEquals('https://test-domain.auth0.com/oauth/token', $api->getHistoryUrl());

        $request_headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $request_headers['Content-Type'][0]);

        $request_body = $api->getHistoryBody();
        $this->assertEquals('the_username', $request_body['username']);
        $this->assertEquals('the_password', $request_body['password']);
        $this->assertEquals('password', $request_body['grant_type']);
        $this->assertEquals('__test_client_id__', $request_body['client_id']);
        $this->assertEquals('__test_client_secret__', $request_body['client_secret']);
    }

    /**
     * Test that a basic password grant realm request includes the realm.
     */
    public function testThatPasswordGrantRealmLoginSendsBasicRequestCorrectly(): void
    {
        $api = new MockAuthenticationApi(
            [
                new Response(200, ['Content-Type' => 'application/json'], '{}'),
            ]
        );

        $api->call()->login(
            [
                'username' => 'the_username',
                'password' => 'the_password',
                'realm' => 'the_realm',
            ]
        );

        $this->assertEquals('https://test-domain.auth0.com/oauth/token', $api->getHistoryUrl());

        $request_body = $api->getHistoryBody();
        $this->assertEquals('the_realm', $request_body['realm']);
        $this->assertEquals('http://auth0.com/oauth/grant-type/password-realm', $request_body['grant_type']);
    }

    /**
     * Test that a password grant request including an IP address sets the correct header.
     */
    public function testThatPasswordGrantLoginSetsForwardedForHeader(): void
    {
        $api = new MockAuthenticationApi(
            [
                new Response(200, ['Content-Type' => 'application/json'], '{}'),
                new Response(200, ['Content-Type' => 'application/json'], '{}'),
            ]
        );

        $api->call()->loginWithDefaultDirectory(
            [
                'username' => uniqid(),
                'password' => uniqid(),
            ],
            '1.2.3.4'
        );

        $request_headers = $api->getHistoryHeaders();
        $this->assertArrayHasKey('Auth0-Forwarded-For', $request_headers);
        $this->assertEquals('1.2.3.4', $request_headers['Auth0-Forwarded-For'][0]);

        $api->call()->loginWithDefaultDirectory(
            [
                'username' => uniqid(),
                'password' => uniqid(),
                'auth0_forwarded_for' => '1.2.3.4',
            ]
        );

        $request_headers = $api->getHistoryHeaders();
        $this->assertArrayHasKey('Auth0-Forwarded-For', $request_headers);
        $this->assertEquals('1.2.3.4', $request_headers['Auth0-Forwarded-For'][0]);
    }

    /**
     * Test that a password grant request including an IP address sets the correct header.
     */
    public function testThatPasswordGrantRealmLoginSetsForwardedForHeader(): void
    {
        $api = new MockAuthenticationApi(
            [
                new Response(200, ['Content-Type' => 'application/json'], '{}'),
                new Response(200, ['Content-Type' => 'application/json'], '{}'),
            ]
        );

        $api->call()->login(
            [
                'username' => uniqid(),
                'password' => uniqid(),
                'realm' => uniqid(),
            ],
            '5.6.7.8'
        );

        $request_headers = $api->getHistoryHeaders();
        $this->assertArrayHasKey('Auth0-Forwarded-For', $request_headers);
        $this->assertEquals('5.6.7.8', $request_headers['Auth0-Forwarded-For'][0]);

        $api->call()->login(
            [
                'username' => uniqid(),
                'password' => uniqid(),
                'realm' => uniqid(),
                'auth0_forwarded_for' => '5.6.7.8',
            ]
        );

        $request_headers = $api->getHistoryHeaders();
        $this->assertArrayHasKey('Auth0-Forwarded-For', $request_headers);
        $this->assertEquals('5.6.7.8', $request_headers['Auth0-Forwarded-For'][0]);
    }
}
