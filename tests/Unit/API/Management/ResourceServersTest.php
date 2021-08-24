<?php

declare(strict_types=1);

uses()->group('management', 'management.resource_servers');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->resourceServers();
});

test('create() issues an appropriate request', function(string $identifier, array $body): void {
    $this->endpoint->create($identifier, $body);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/resource-servers', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());

    $request = $this->api->getRequestBody();
    $this->assertArrayHasKey('identifier', $request);
    $this->assertEquals($identifier, $request['identifier']);
    $this->assertArrayHasKey('test', $request);
    $this->assertEquals($body['test'], $request['test']);

    $request = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['identifier' => $identifier] + $body), $request);
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => [ 'test' => uniqid() ],
]]);

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll();

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/resource-servers', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
});

test('get() issues an appropriate request', function(string $id): void {
    $this->endpoint->get($id);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/resource-servers/' . $id, $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
})->with(['mocked id' => [
    fn() => uniqid(),
]]);

test('update() issues an appropriate request', function(string $id, array $body): void {
    $this->endpoint->update($id, $body);

    $this->assertEquals('PATCH', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/resource-servers/' . $id, $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());

    $request = $this->api->getRequestBody();
    $this->assertArrayHasKey('test', $request);
    $this->assertEquals($body['test'], $request['test']);

    $request = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode($body), $request);
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => [ 'test' => uniqid() ],
]]);

test('delete() issues an appropriate request', function(string $id): void {
    $this->endpoint->delete($id);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/resource-servers/' . $id, $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
})->with(['mocked id' => [
    fn() => uniqid(),
]]);
