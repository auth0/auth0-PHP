<?php

declare(strict_types=1);

uses()->group('management', 'management.client_grants');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->clientGrants();
});

test('create() throws an error when clientId is missing', function(): void {
    $this->endpoint->create('', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'clientId'));

test('create() throws an error when audience is missing', function(): void {
    $this->endpoint->create(uniqid(), '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'audience'));

test('create() issues an appropriate request', function(): void {
    $clientId = uniqid();
    $audience = uniqid();
    $scope = uniqid();

    $this->endpoint->create($clientId, $audience, [$scope]);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/client-grants');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('client_id', $body);
    $this->assertArrayHasKey('audience', $body);
    $this->assertArrayHasKey('scope', $body);
    expect($body['client_id'])->toEqual($clientId);
    expect($body['audience'])->toEqual($audience);
    expect($body['scope'])->toContain($scope);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['client_id' => $clientId, 'audience' => $audience, 'scope' => [$scope]]));
});

test('getAll() issues an appropriate request', function(): void {
    $exampleParam = uniqid();

    $this->endpoint->getAll(['example' => $exampleParam]);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/client-grants');

    expect($this->api->getRequestQuery(null))->toEqual('example=' . $exampleParam);
});

test('getAll() supports field filtering parameters', function(): void {
    $field1 = uniqid();
    $field2 = uniqid();
    $this->filteredRequest->setFields([$field1, $field2])->setIncludeFields(true);

    $this->endpoint->getAll(null, $this->requestOptions);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/client-grants');

    expect($this->api->getRequestQuery())->toContain('&fields=' . rawurlencode($field1 . ',' . $field2));
    expect($this->api->getRequestQuery())->toContain('&include_fields=true');
});

test('getAll() supports standard pagination parameters', function(): void {
    $this->paginatedRequest->setPage(1)->setPerPage(5)->setIncludeTotals(true);

    $this->endpoint->getAll(null, $this->requestOptions);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/client-grants');

    expect($this->api->getRequestQuery())->toContain('&page=1');
    expect($this->api->getRequestQuery())->toContain('&per_page=5');
    expect($this->api->getRequestQuery())->toContain('&include_totals=true');
});

test('getAllByAudience() issues an appropriate request', function(): void {
    $audience = uniqid();

    $this->endpoint->getAllByAudience($audience);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/client-grants');

    expect($this->api->getRequestQuery(null))->toEqual('audience=' . $audience);
});

test('getAllByClientId() issues an appropriate request', function(): void {
    $clientId = uniqid();

    $this->endpoint->getAllByClientId($clientId);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/client-grants');

    expect($this->api->getRequestQuery(null))->toEqual('client_id=' . $clientId);
});

test('update() issues an appropriate request', function(): void {
    $grantId = uniqid();
    $scope = uniqid();

    $this->endpoint->update($grantId, [$scope]);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/client-grants/' . $grantId);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('scope', $body);
    expect($body['scope'])->toContain($scope);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['scope' => [$scope]]));
});

test('delete() issues an appropriate request', function(): void {
    $grantId = uniqid();

    $this->endpoint->delete($grantId);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/client-grants/' . $grantId);
});
