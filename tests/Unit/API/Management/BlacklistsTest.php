<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Request\FilteredRequest;
use Auth0\SDK\Utility\Request\PaginatedRequest;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\Tests\Utilities\MockManagementApi;

uses()->group('management', 'blacklists');

beforeEach(function(): void {
    $this->sdk = new MockManagementApi();

    $this->filteredRequest = new FilteredRequest();
    $this->paginatedRequest = new PaginatedRequest();
    $this->requestOptions = new RequestOptions(
        $this->filteredRequest,
        $this->paginatedRequest
    );
});

test('create() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->blacklists();

    $jti = uniqid();
    $aud = uniqid();

    $endpoint->create($jti, $aud);

    $this->assertEquals('POST', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/blacklists/tokens', $this->sdk->getRequestUrl());
    $this->assertEmpty($this->sdk->getRequestQuery());

    $body = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('aud', $body);
    $this->assertEquals($aud, $body['aud']);
    $this->assertArrayHasKey('jti', $body);
    $this->assertEquals($jti, $body['jti']);

    $body = $this->sdk->getRequestBodyAsString();
    $this->assertEquals(json_encode(['jti' => $jti, 'aud' => $aud]), $body);
});

test('get() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->blacklists();

    $aud = uniqid();

    $endpoint->get($aud);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/blacklists/tokens', $this->sdk->getRequestUrl());

    $this->assertEquals('aud=' . $aud, $this->sdk->getRequestQuery(null));
});
