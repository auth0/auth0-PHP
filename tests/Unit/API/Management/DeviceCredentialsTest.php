<?php

declare(strict_types=1);

uses()->group('management', 'management.device_credentials');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->deviceCredentials();
});

test('create() throws an error when missing deviceName', function(): void {
    $this->endpoint->create('', '', '', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'deviceName'));

test('create() throws an error when missing type', function(): void {
    $this->endpoint->create(uniqid(), '', '', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'type'));

test('create() throws an error when missing value', function(): void {
    $this->endpoint->create(uniqid(), uniqid(), '', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'value'));

test('create() throws an error when missing deviceId', function(): void {
    $this->endpoint->create(uniqid(), uniqid(), uniqid(), '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'deviceId'));

test('create() issues valid requests', function(): void {
    $deviceName = uniqid();
    $type = uniqid();
    $value = uniqid();
    $deviceId = uniqid();
    $additional = uniqid();

    $this->endpoint->create($deviceName, $type, $value, $deviceId, ['additional' => $additional]);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/device-credentials');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('device_name', $body);
    $this->assertArrayHasKey('type', $body);
    $this->assertArrayHasKey('value', $body);
    $this->assertArrayHasKey('device_id', $body);
    $this->assertArrayHasKey('additional', $body);
    expect($body['device_name'])->toEqual($deviceName);
    expect($body['type'])->toEqual($type);
    expect($body['value'])->toEqual($value);
    expect($body['device_id'])->toEqual($deviceId);
    expect($body['additional'])->toEqual($additional);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['device_name' => $deviceName, 'type' => $type, 'value' => $value, 'device_id' => $deviceId, 'additional' => $additional]));
});

test('get() issues valid requests', function(): void {
    $userId = uniqid();
    $clientId = uniqid();
    $type = uniqid();

    $this->endpoint->get($userId, $clientId, $type);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/device-credentials');

    expect($this->api->getRequestQuery())->toContain('&user_id=' . $userId);
    expect($this->api->getRequestQuery())->toContain('&client_id=' . $clientId);
    expect($this->api->getRequestQuery())->toContain('&type=' . $type);
});

test('delete() issues valid requests', function(): void {
    $id = uniqid();

    $this->endpoint->delete($id);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/device-credentials/' . $id);
});
