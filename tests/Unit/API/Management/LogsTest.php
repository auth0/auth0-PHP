<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Request\FilteredRequest;
use Auth0\SDK\Utility\Request\PaginatedRequest;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\Tests\Utilities\MockManagementApi;

uses()->group('management', 'logs');

beforeEach(function(): void {
    $this->sdk = new MockManagementApi();
});

test('getAll() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->logs();

    $endpoint->getAll();

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/logs', $this->sdk->getRequestUrl());
});

test('get() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->logs();

    $logId = uniqid();

    $endpoint->get($logId);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/logs/' . $logId, $this->sdk->getRequestUrl());
});
