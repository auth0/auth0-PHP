<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Request\FilteredRequest;
use Auth0\SDK\Utility\Request\PaginatedRequest;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\Tests\Utilities\MockManagementApi;

uses()->group('management', 'emails');

beforeEach(function(): void {
    $this->sdk = new MockManagementApi();

    $this->filteredRequest = new FilteredRequest();
    $this->paginatedRequest = new PaginatedRequest();
    $this->requestOptions = new RequestOptions(
        $this->filteredRequest,
        $this->paginatedRequest
    );
});

test('createProvider() throws an error when missing required arguments', function(): void {
    $endpoint = $this->sdk->mock()->emails();

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'name'));

    $endpoint->createProvider('', []);

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'credentials'));

    $endpoint->createProvider(uniqid(), []);
});

test('createProvider() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->emails();

    $name = uniqid();
    $credentials = [
        'api_user' => uniqid(),
        'region' => uniqid(),
        'smtp_host' => uniqid(),
        'smtp_port' => uniqid(),
        'smtp_user' => uniqid()
    ];
    $additional = [
        'test1' => uniqid(),
        'test2' => uniqid(),
    ];

    $endpoint->createProvider($name, $credentials, ['additional' => $additional]);

    $this->assertEquals('POST', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/emails/provider', $this->sdk->getRequestUrl());

    $body = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertArrayHasKey('credentials', $body);
    $this->assertArrayHasKey('additional', $body);
    $this->assertCount(5, $body['credentials']);
    $this->assertEquals($name, $body['name']);
    $this->assertEquals($credentials, $body['credentials']);
    $this->assertEquals($additional, $body['additional']);

    $body = $this->sdk->getRequestBodyAsString();
    $this->assertEquals(json_encode(['name' => $name, 'credentials' => $credentials, 'additional' => $additional]), $body);
});

test('getProvider() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->emails();

    $endpoint->getProvider();

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/emails/provider', $this->sdk->getRequestUrl());
});

test('updateProvider() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->emails();

    $name = uniqid();
    $credentials = [
        'api_user' => uniqid(),
        'region' => uniqid(),
        'smtp_host' => uniqid(),
        'smtp_port' => uniqid(),
        'smtp_user' => uniqid()
    ];
    $additional = [
        'test1' => uniqid(),
        'test2' => uniqid(),
    ];

    $endpoint->updateProvider($name, $credentials, ['additional' => $additional]);

    $this->assertEquals('PATCH', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/emails/provider', $this->sdk->getRequestUrl());

    $body = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertArrayHasKey('credentials', $body);
    $this->assertArrayHasKey('additional', $body);
    $this->assertCount(5, $body['credentials']);
    $this->assertEquals($name, $body['name']);
    $this->assertEquals($credentials, $body['credentials']);
    $this->assertEquals($additional, $body['additional']);

    $body = $this->sdk->getRequestBodyAsString();
    $this->assertEquals(json_encode(['name' => $name, 'credentials' => $credentials, 'additional' => $additional]), $body);
});

test('delete() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->emails();

    $endpoint->deleteProvider();

    $this->assertEquals('DELETE', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/emails/provider', $this->sdk->getRequestUrl());
});
