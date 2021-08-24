<?php

declare(strict_types=1);

uses()->group('management', 'management.tenants');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->userBlocks();
});

test('get() issues an appropriate request', function(string $id): void {
    $this->endpoint->get($id);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/user-blocks/' . $id, $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
})->with(['mocked id' => [
    fn() => uniqid(),
]]);

test('delete() issues an appropriate request', function(string $id): void {
    $this->endpoint->delete($id);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/user-blocks/' . $id, $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
})->with(['mocked id' => [
    fn() => uniqid(),
]]);

test('getByIdentifier() issues an appropriate request', function(string $identifier): void {
    $this->endpoint->getByIdentifier($identifier);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/user-blocks', $this->api->getRequestUrl());
    $this->assertStringContainsString('identifier=' . $identifier, $this->api->getRequestQuery(null));
})->with(['mocked identifier' => [
    fn() => uniqid(),
]]);

test('deleteByIdentifier() issues an appropriate request', function(string $identifier): void {
    $this->endpoint->deleteByIdentifier($identifier);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/user-blocks', $this->api->getRequestUrl());
    $this->assertStringContainsString('identifier=' . $identifier, $this->api->getRequestQuery(null));
})->with(['mocked identifier' => [
    fn() => uniqid(),
]]);
