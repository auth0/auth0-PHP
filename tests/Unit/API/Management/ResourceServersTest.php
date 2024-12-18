<?php

declare(strict_types=1);

uses()->group('management', 'management.resource_servers');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->resourceServers();
});

test('create() issues an appropriate request', function(string $identifier, array $body): void {
    $this->endpoint->create($identifier, $body);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/resource-servers');
    expect($this->api->getRequestQuery())->toBeEmpty();

    $request = $this->api->getRequestBody();
    $this->assertArrayHasKey('identifier', $request);
    expect($request['identifier'])->toEqual($identifier);
    $this->assertArrayHasKey('test', $request);
    expect($request['test'])->toEqual($body['test']);

    $request = $this->api->getRequestBodyAsString();
    expect($request)->toEqual(json_encode(['identifier' => $identifier] + $body));
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => [ 'test' => uniqid() ],
]]);

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/resource-servers');
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('get() issues an appropriate request', function(string $id): void {
    $this->endpoint->get($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/resource-servers/' . $id);
    expect($this->api->getRequestQuery())->toBeEmpty();
})->with(['mocked id' => [
    fn() => uniqid(),
]]);

test('update() issues an appropriate request', function(string $id, array $body): void {
    $this->endpoint->update($id, $body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/resource-servers/' . $id);
    expect($this->api->getRequestQuery())->toBeEmpty();

    $request = $this->api->getRequestBody();
    $this->assertArrayHasKey('test', $request);
    expect($request['test'])->toEqual($body['test']);

    $request = $this->api->getRequestBodyAsString();
    expect($request)->toEqual(json_encode($body));
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => [ 'test' => uniqid() ],
]]);

test('delete() issues an appropriate request', function(string $id): void {
    $this->endpoint->delete($id);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/resource-servers/' . $id);
    expect($this->api->getRequestQuery())->toBeEmpty();
})->with(['mocked id' => [
    fn() => uniqid(),
]]);

test('getAll() issues an appropriate request with identifiers array', function(): void {
    $identifiers = ['https://tst.api.com/api/v1/', 'https://tst.api.com/api/v2/'];
    
    $this->endpoint->getAll(null, ['identifiers' => $identifiers]);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://' . $this->api->mock()->getConfiguration()->getDomain() . '/api/v2/resource-servers');

    expect($this->api->getRequestUrl())->toContain(rawurlencode('identifiers[0]') .'='. rawurlencode('https://tst.api.com/api/v1/'));
    expect($this->api->getRequestUrl())->toContain(rawurlencode('identifiers[1]') .'='. rawurlencode('https://tst.api.com/api/v2/'));
});

test('getAll() supports checkpoint pagination parameters', function(): void {
    $this->paginatedRequest->setFrom('indexIdentifier')->setTake(50);
    
    $this->endpoint->getAll($this->requestOptions, null);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://' . $this->api->mock()->getConfiguration()->getDomain() . '/api/v2/resource-servers');

    expect($this->api->getRequestQuery())->toContain('&from=indexIdentifier');
    expect($this->api->getRequestQuery())->toContain('&take=50');
});