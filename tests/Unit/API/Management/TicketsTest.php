<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

class TicketsTest extends TestCase
{
    public function testCreateEmailVerification(): void
    {
        $api = new MockManagementApi();

        $api->mock()->tickets()->createEmailVerification(
            '__test_user_id__',
            [
                'identity' => [
                    'user_id' => '__test_secondary_user_id__',
                    'provider' => '__test_provider__',
                ],
            ]
        );

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/tickets/email-verification', $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('user_id', $body);
        $this->assertEquals('__test_user_id__', $body['user_id']);
        $this->assertArrayHasKey('identity', $body);
        $this->assertEquals(
            [
                'user_id' => '__test_secondary_user_id__',
                'provider' => '__test_provider__',
            ],
            $body['identity']
        );

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }

    public function testCreatePasswordChange(): void
    {
        $api = new MockManagementApi();

        $api->mock()->tickets()->createPasswordChange(
            [
                'user_id' => '__test_user_id__',
                'new_password' => '__test_password__',
                'result_url' => '__test_result_url__',
                'connection_id' => '__test_connection_id__',
                'ttl_sec' => 8675309,
                'client_id' => '__test_client_id__',
            ]
        );

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/tickets/password-change', $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('user_id', $body);
        $this->assertEquals('__test_user_id__', $body['user_id']);
        $this->assertArrayHasKey('new_password', $body);
        $this->assertEquals('__test_password__', $body['new_password']);
        $this->assertArrayHasKey('result_url', $body);
        $this->assertEquals('__test_result_url__', $body['result_url']);
        $this->assertArrayHasKey('connection_id', $body);
        $this->assertEquals('__test_connection_id__', $body['connection_id']);
        $this->assertArrayHasKey('ttl_sec', $body);
        $this->assertEquals(8675309, $body['ttl_sec']);
        $this->assertArrayHasKey('client_id', $body);
        $this->assertEquals('__test_client_id__', $body['client_id']);

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }
}
