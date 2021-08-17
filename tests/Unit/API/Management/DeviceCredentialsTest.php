<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Request\FilteredRequest;
use Auth0\SDK\Utility\Request\PaginatedRequest;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\Tests\Utilities\MockManagementApi;

uses()->group('management', 'devicecredentials');

beforeEach(function(): void {
    $this->sdk = new MockManagementApi();

    $this->filteredRequest = new FilteredRequest();
    $this->paginatedRequest = new PaginatedRequest();
    $this->requestOptions = new RequestOptions(
        $this->filteredRequest,
        $this->paginatedRequest
    );
});

test('create() throws an error when missing required variables', function(): void {
    $endpoint = $this->sdk->mock()->deviceCredentials();

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'deviceName'));

    $endpoint->create('', '', '', '');

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'type'));

    $endpoint->create(uniqid(), '', '', '');

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'value'));

    $endpoint->create(uniqid(), uniqid(), '', '');

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'deviceId'));

    $endpoint->create(uniqid(), uniqid(), uniqid(), '');
});

test('create() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->deviceCredentials();

    $deviceName = uniqid();
    $type = uniqid();
    $value = uniqid();
    $deviceId = uniqid();
    $additional = uniqid();

    $endpoint->create($deviceName, $type, $value, $deviceId, ['additional' => $additional]);

    $this->assertEquals('POST', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/device-credentials', $this->sdk->getRequestUrl());

    $body = $this->sdk->getRequestBody();
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

    $body = $this->sdk->getRequestBodyAsString();
    $this->assertEquals(json_encode(['device_name' => $deviceName, 'type' => $type, 'value' => $value, 'device_id' => $deviceId, 'additional' => $additional]), $body);
});

test('get() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->deviceCredentials();

    $userId = uniqid();
    $clientId = uniqid();
    $type = uniqid();

    $endpoint->get($userId, $clientId, $type);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/device-credentials', $this->sdk->getRequestUrl());

    $this->assertStringContainsString('&user_id=' . $userId, $this->sdk->getRequestQuery());
    $this->assertStringContainsString('&client_id=' . $clientId, $this->sdk->getRequestQuery());
    $this->assertStringContainsString('&type=' . $type, $this->sdk->getRequestQuery());
});

test('delete() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->deviceCredentials();

    $id = uniqid();

    $endpoint->delete($id);

    $this->assertEquals('DELETE', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/device-credentials/' . $id, $this->sdk->getRequestUrl());
});
