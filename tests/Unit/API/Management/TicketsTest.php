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

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/tickets/email-verification');
    expect($this->api->getRequestQuery())->toBeEmpty();

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('user_id', $body);
    expect($body['user_id'])->toEqual($mock->userId);
    $this->assertArrayHasKey('identity', $body);
    expect($body['identity'])->toEqual($mock->identity);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['user_id' => $mock->userId, 'identity' => $mock->identity]));
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

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/tickets/password-change');
    expect($this->api->getRequestQuery())->toBeEmpty();

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('user_id', $body);
    expect($body['user_id'])->toEqual($mock['user_id']);
    $this->assertArrayHasKey('new_password', $body);
    expect($body['new_password'])->toEqual($mock['new_password']);
    $this->assertArrayHasKey('result_url', $body);
    expect($body['result_url'])->toEqual($mock['result_url']);
    $this->assertArrayHasKey('connection_id', $body);
    expect($body['connection_id'])->toEqual($mock['connection_id']);
    $this->assertArrayHasKey('ttl_sec', $body);
    expect($body['ttl_sec'])->toEqual($mock['ttl_sec']);
    $this->assertArrayHasKey('client_id', $body);
    expect($body['client_id'])->toEqual($mock['client_id']);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode($mock));
});
