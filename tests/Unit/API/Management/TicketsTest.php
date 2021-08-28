<?php

declare(strict_types=1);

uses()->group('management', 'management.tickets');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->tickets();
});

test('createEmailVerification() issues an appropriate request', function(): void {
    $mock = (object) [
        'userId' => uniqid(),
        'identity' => [
            'user_id' => '__test_secondary_user_id__',
            'provider' => '__test_provider__',
        ],
    ];

    $this->endpoint->createEmailVerification($mock->userId, ['identity' => $mock->identity]);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/tickets/email-verification', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('user_id', $body);
    $this->assertEquals($mock->userId, $body['user_id']);
    $this->assertArrayHasKey('identity', $body);
    $this->assertEquals($mock->identity, $body['identity']);

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['user_id' => $mock->userId, 'identity' => $mock->identity]), $body);
});

test('createPasswordChange() issues an appropriate request', function(): void {
    $mock = [
        'user_id' => uniqid(),
        'new_password' => uniqid(),
        'result_url' => uniqid(),
        'connection_id' => uniqid(),
        'ttl_sec' => uniqid(),
        'client_id' => uniqid(),
    ];

    $this->endpoint->createPasswordChange($mock);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/tickets/password-change', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());

    $body = $this->api->getRequestBody();
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

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode($mock), $body);
});
