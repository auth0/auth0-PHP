<?php

declare(strict_types=1);

namespace Auth0\Tests\unit\API\Authentication;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

/**
 * Class RefreshTokenTest.
 * Tests the \Auth0\SDK\API\Authentication::refreshToken() method.
 */
class RefreshTokenTest extends ApiTests
{
    /**
     * Expected telemetry value.
     */
    protected static string $expectedTelemetry;

    /**
     * Default request headers.
     */
    protected static array $headers = ['content-type' => 'json'];

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass(): void
    {
        $infoHeadersData = new InformationHeaders();
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    /**
     * Test that an empty refresh token will throw an exception.
     */
    public function testThatRefreshTokenIsRequired(): void
    {
        $api = new Authentication('test_domain', 'test_client_id', 'test_client_secret');

        $this->expectException(\Auth0\SDK\Exception\ApiException::class);
        $this->expectExceptionMessage('Refresh token cannot be blank');

        $api->refreshToken('');
    }

    /**
     * Test that setting an empty client_secret will override the default and throw an exception.
     */
    public function testThatClientSecretIsRequired(): void
    {
        $api = new Authentication('test_domain', 'test_client_id', 'test_client_secret');

        $this->expectException(\Auth0\SDK\Exception\ApiException::class);
        $this->expectExceptionMessage('client_secret is mandatory');

        $api->refreshToken(uniqid(), ['client_secret' => '']);
    }

    /**
     * Test that setting an empty client_id will override the default and throw an exception.
     */
    public function testThatClientIdIsRequired(): void
    {
        $api = new Authentication('test_domain', 'test_client_id', 'test_client_secret');

        $this->expectException(\Auth0\SDK\Exception\ApiException::class);
        $this->expectExceptionMessage('client_id is mandatory');

        $api->refreshToken(uniqid(), ['client_id' => '']);
    }

    /**
     * Test that the refresh token request is made successfully.
     *
     * @throws ApiException
     */
    public function testThatRefreshTokenRequestIsMadeCorrectly(): void
    {
        $api = new MockAuthenticationApi(
            [
                new Response(200, ['Content-Type' => 'application/json'], '{}'),
            ]
        );

        $refresh_token = uniqid();
        $api->call()->refreshToken($refresh_token);

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://test-domain.auth0.com/oauth/token', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());

        $request_body = $api->getHistoryBody();
        $this->assertEquals('refresh_token', $request_body['grant_type']);
        $this->assertEquals('__test_client_id__', $request_body['client_id']);
        $this->assertEquals('__test_client_secret__', $request_body['client_secret']);
        $this->assertEquals($refresh_token, $request_body['refresh_token']);
    }
}
