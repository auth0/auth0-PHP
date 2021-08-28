<?php

declare(strict_types=1);

uses()->group('management', 'management.device_credentials');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->deviceCredentials();
});

test('create() throws an error when missing deviceName', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'deviceName'));

    $this->endpoint->create('', '', '', '');
});

test('create() throws an error when missing type', function(): void {

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'type'));

    $this->endpoint->create(uniqid(), '', '', '');
});

test('create() throws an error when missing value', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'value'));

    $this->endpoint->create(uniqid(), uniqid(), '', '');
});

test('create() throws an error when missing deviceId', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'deviceId'));

    $this->endpoint->create(uniqid(), uniqid(), uniqid(), '');
});

test('create() issues valid requests', function(): void {
    $deviceName = uniqid();
    $type = uniqid();
    $value = uniqid();
    $deviceId = uniqid();
    $additional = uniqid();

    $this->endpoint->create($deviceName, $type, $value, $deviceId, ['additional' => $additional]);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/device-credentials', $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('device_name', $body);
    $this->assertArrayHasKey('type', $body);
    $this->assertArrayHasKey('value', $body);
    $this->assertArrayHasKey('device_id', $body);
    $this->assertArrayHasKey('additional', $body);
    $this->assertEquals($deviceName, $body['device_name']);
    $this->assertEquals($type, $body['type']);
    $this->assertEquals($value, $body['value']);
    $this->assertEquals($deviceId, $body['device_id']);
    $this->assertEquals($additional, $body['additional']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['device_name' => $deviceName, 'type' => $type, 'value' => $value, 'device_id' => $deviceId, 'additional' => $additional]), $body);
});

test('get() issues valid requests', function(): void {
    $userId = uniqid();
    $clientId = uniqid();
    $type = uniqid();

    $this->endpoint->get($userId, $clientId, $type);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/device-credentials', $this->api->getRequestUrl());

    $this->assertStringContainsString('&user_id=' . $userId, $this->api->getRequestQuery());
    $this->assertStringContainsString('&client_id=' . $clientId, $this->api->getRequestQuery());
    $this->assertStringContainsString('&type=' . $type, $this->api->getRequestQuery());
});

test('delete() issues valid requests', function(): void {
    $id = uniqid();

    $this->endpoint->delete($id);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/device-credentials/' . $id, $this->api->getRequestUrl());
});
