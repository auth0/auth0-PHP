<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Request\FilteredRequest;
use Auth0\SDK\Utility\Request\PaginatedRequest;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\Tests\Utilities\MockManagementApi;

uses()->group('management', 'clientgrants');

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
    $endpoint = $this->sdk->mock()->clientGrants();

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'clientId'));

    $endpoint->create('', '');

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'audience'));

    $endpoint->create(uniqid(), '');
});

test('create() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->clientGrants();

    $clientId = uniqid();
    $audience = uniqid();
    $scope = uniqid();

    $endpoint->create($clientId, $audience, [$scope]);

    $this->assertEquals('POST', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/client-grants', $this->sdk->getRequestUrl());

    $body = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('client_id', $body);
    $this->assertArrayHasKey('audience', $body);
    $this->assertArrayHasKey('scope', $body);
    $this->assertEquals($clientId, $body['client_id']);
    $this->assertEquals($audience, $body['audience']);
    $this->assertContains($scope, $body['scope']);

    $body = $this->sdk->getRequestBodyAsString();
    $this->assertEquals(json_encode(['client_id' => $clientId, 'audience' => $audience, 'scope' => [$scope]]), $body);
});

test('getAll() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->clientGrants();

    $exampleParam = uniqid();

    $endpoint->getAll(['example' => $exampleParam]);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/client-grants', $this->sdk->getRequestUrl());

    $this->assertEquals('example=' . $exampleParam, $this->sdk->getRequestQuery(null));
});

test('getAll() supports field filtering parameters', function(): void {
    $endpoint = $this->sdk->mock()->clientGrants();

    $field1 = uniqid();
    $field2 = uniqid();
    $this->filteredRequest->setFields([$field1, $field2])->setIncludeFields(true);

    $endpoint->getAll(null, $this->requestOptions);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/client-grants', $this->sdk->getRequestUrl());

    $this->assertStringContainsString('&fields=' . rawurlencode($field1 . ',' . $field2), $this->sdk->getRequestQuery());
    $this->assertStringContainsString('&include_fields=true', $this->sdk->getRequestQuery());
});

test('getAll() supports standard pagination parameters', function(): void {
    $endpoint = $this->sdk->mock()->clientGrants();

    $this->paginatedRequest->setPage(1)->setPerPage(5)->setIncludeTotals(true);

    $endpoint->getAll(null, $this->requestOptions);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/client-grants', $this->sdk->getRequestUrl());

    $this->assertStringContainsString('&page=1', $this->sdk->getRequestQuery());
    $this->assertStringContainsString('&per_page=5', $this->sdk->getRequestQuery());
    $this->assertStringContainsString('&include_totals=true', $this->sdk->getRequestQuery());
});

test('getAllByAudience() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->clientGrants();

    $audience = uniqid();

    $endpoint->getAllByAudience($audience);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/client-grants', $this->sdk->getRequestUrl());

    $this->assertEquals('audience=' . $audience, $this->sdk->getRequestQuery(null));
});

test('getAllByClientId() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->clientGrants();

    $clientId = uniqid();

    $endpoint->getAllByClientId($clientId);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/client-grants', $this->sdk->getRequestUrl());

    $this->assertEquals('client_id=' . $clientId, $this->sdk->getRequestQuery(null));
});

test('update() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->clientGrants();

    $grantId = uniqid();
    $scope = uniqid();

    $endpoint->update($grantId, [$scope]);

    $this->assertEquals('PATCH', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/client-grants/' . $grantId, $this->sdk->getRequestUrl());

    $body = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('scope', $body);
    $this->assertContains($scope, $body['scope']);

    $body = $this->sdk->getRequestBodyAsString();
    $this->assertEquals(json_encode(['scope' => [$scope]]), $body);
});

test('delete() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->clientGrants();

    $grantId = uniqid();

    $endpoint->delete($grantId);

    $this->assertEquals('DELETE', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/client-grants/' . $grantId, $this->sdk->getRequestUrl());
});
