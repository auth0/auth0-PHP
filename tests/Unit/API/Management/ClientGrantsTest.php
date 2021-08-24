<?php

declare(strict_types=1);

uses()->group('management', 'management.client_grants');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->clientGrants();
});

test('create() throws an error when clientId is missing', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'clientId'));

    $this->endpoint->create('', '');
});

test('create() throws an error when audience is missing', function(): void {

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'audience'));

    $this->endpoint->create(uniqid(), '');
});

test('create() issues an appropriate request', function(): void {
    $clientId = uniqid();
    $audience = uniqid();
    $scope = uniqid();

    $this->endpoint->create($clientId, $audience, [$scope]);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/client-grants', $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('client_id', $body);
    $this->assertArrayHasKey('audience', $body);
    $this->assertArrayHasKey('scope', $body);
    $this->assertEquals($clientId, $body['client_id']);
    $this->assertEquals($audience, $body['audience']);
    $this->assertContains($scope, $body['scope']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['client_id' => $clientId, 'audience' => $audience, 'scope' => [$scope]]), $body);
});

test('getAll() issues an appropriate request', function(): void {
    $exampleParam = uniqid();

    $this->endpoint->getAll(['example' => $exampleParam]);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/client-grants', $this->api->getRequestUrl());

    $this->assertEquals('example=' . $exampleParam, $this->api->getRequestQuery(null));
});

test('getAll() supports field filtering parameters', function(): void {
    $field1 = uniqid();
    $field2 = uniqid();
    $this->filteredRequest->setFields([$field1, $field2])->setIncludeFields(true);

    $this->endpoint->getAll(null, $this->requestOptions);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/client-grants', $this->api->getRequestUrl());

    $this->assertStringContainsString('&fields=' . rawurlencode($field1 . ',' . $field2), $this->api->getRequestQuery());
    $this->assertStringContainsString('&include_fields=true', $this->api->getRequestQuery());
});

test('getAll() supports standard pagination parameters', function(): void {
    $this->paginatedRequest->setPage(1)->setPerPage(5)->setIncludeTotals(true);

    $this->endpoint->getAll(null, $this->requestOptions);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/client-grants', $this->api->getRequestUrl());

    $this->assertStringContainsString('&page=1', $this->api->getRequestQuery());
    $this->assertStringContainsString('&per_page=5', $this->api->getRequestQuery());
    $this->assertStringContainsString('&include_totals=true', $this->api->getRequestQuery());
});

test('getAllByAudience() issues an appropriate request', function(): void {
    $audience = uniqid();

    $this->endpoint->getAllByAudience($audience);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/client-grants', $this->api->getRequestUrl());

    $this->assertEquals('audience=' . $audience, $this->api->getRequestQuery(null));
});

test('getAllByClientId() issues an appropriate request', function(): void {
    $clientId = uniqid();

    $this->endpoint->getAllByClientId($clientId);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/client-grants', $this->api->getRequestUrl());

    $this->assertEquals('client_id=' . $clientId, $this->api->getRequestQuery(null));
});

test('update() issues an appropriate request', function(): void {
    $grantId = uniqid();
    $scope = uniqid();

    $this->endpoint->update($grantId, [$scope]);

    $this->assertEquals('PATCH', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/client-grants/' . $grantId, $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('scope', $body);
    $this->assertContains($scope, $body['scope']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['scope' => [$scope]]), $body);
});

test('delete() issues an appropriate request', function(): void {
    $grantId = uniqid();

    $this->endpoint->delete($grantId);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/client-grants/' . $grantId, $this->api->getRequestUrl());
});
