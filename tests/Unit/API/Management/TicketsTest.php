<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

class TicketsTest extends TestCase
{
    public function testCreateEmailVerification(): void
    {
        $mock = (object) [
            'userId' => uniqid(),
            'identity' => [
                'user_id' => '__test_secondary_user_id__',
                'provider' => '__test_provider__',
            ],
        ];

        $api = new MockManagementApi();

        $api->mock()->tickets()->createEmailVerification($mock->userId, ['identity' => $mock->identity]);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/tickets/email-verification', $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('user_id', $body);
        $this->assertEquals($mock->userId, $body['user_id']);
        $this->assertArrayHasKey('identity', $body);
        $this->assertEquals($mock->identity, $body['identity']);

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(['user_id' => $mock->userId, 'identity' => $mock->identity]), $body);
    }

    public function testCreatePasswordChange(): void
    {
        $mock = [
            'user_id' => uniqid(),
            'new_password' => uniqid(),
            'result_url' => uniqid(),
            'connection_id' => uniqid(),
            'ttl_sec' => uniqid(),
            'client_id' => uniqid(),
        ];

        $api = new MockManagementApi();

        $api->mock()->tickets()->createPasswordChange($mock);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/tickets/password-change', $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('user_id', $body);
        $this->assertEquals($mock['user_id'], $body['user_id']);
        $this->assertArrayHasKey('new_password', $body);
        $this->assertEquals($mock['new_password'], $body['new_password']);
        $this->assertArrayHasKey('result_url', $body);
        $this->assertEquals($mock['result_url'], $body['result_url']);
        $this->assertArrayHasKey('connection_id', $body);
        $this->assertEquals($mock['connection_id'], $body['connection_id']);
        $this->assertArrayHasKey('ttl_sec', $body);
        $this->assertEquals($mock['ttl_sec'], $body['ttl_sec']);
        $this->assertArrayHasKey('client_id', $body);
        $this->assertEquals($mock['client_id'], $body['client_id']);

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode($mock), $body);
    }
}
