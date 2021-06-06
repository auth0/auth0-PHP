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
    $endpoint = $this->sdk->mock()->Emails();

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'name'));

    $endpoint->createProvider('', []);

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'credentials'));

    $endpoint->createProvider(uniqid(), []);
});

test('createProvider() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->Emails();

    $name = uniqid();
    $credentials = uniqid();
    $additional = uniqid();

    $endpoint->createProvider($name, [$credentials], ['additional' => $additional]);

    $this->assertEquals('POST', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/emails/provider', $this->sdk->getRequestUrl());

    $body = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertArrayHasKey('credentials', $body);
    $this->assertArrayHasKey('additional', $body);
    $this->assertCount(1, $body['credentials']);
    $this->assertEquals($name, $body['name']);
    $this->assertEquals($credentials, $body['credentials'][0]);
    $this->assertEquals($additional, $body['additional']);
});

test('getProvider() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->Emails();

    $endpoint->getProvider();

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/emails/provider', $this->sdk->getRequestUrl());
});

test('updateProvider() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->Emails();

    $name = uniqid();
    $credentials = uniqid();
    $additional = uniqid();

    $endpoint->updateProvider($name, [$credentials], ['additional' => $additional]);

    $this->assertEquals('PATCH', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/emails/provider', $this->sdk->getRequestUrl());

    $body = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertArrayHasKey('credentials', $body);
    $this->assertArrayHasKey('additional', $body);
    $this->assertCount(1, $body['credentials']);
    $this->assertEquals($name, $body['name']);
    $this->assertEquals($credentials, $body['credentials'][0]);
    $this->assertEquals($additional, $body['additional']);
});

test('delete() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->Emails();

    $endpoint->deleteProvider();

    $this->assertEquals('DELETE', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/emails/provider', $this->sdk->getRequestUrl());
});
