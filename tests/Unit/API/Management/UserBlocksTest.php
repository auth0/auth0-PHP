<?php

declare(strict_types=1);

uses()->group('management', 'management.user_blocks');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->userBlocks();
});

test('get() issues an appropriate request', function(string $id): void {
    $this->endpoint->get($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/user-blocks/' . $id);
    expect($this->api->getRequestQuery())->toBeEmpty();
})->with(['mocked id' => [
    fn() => uniqid(),
]]);

test('delete() issues an appropriate request', function(string $id): void {
    $this->endpoint->delete($id);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/user-blocks/' . $id);
    expect($this->api->getRequestQuery())->toBeEmpty();
})->with(['mocked id' => [
    fn() => uniqid(),
]]);

test('getByIdentifier() issues an appropriate request', function(string $identifier): void {
    $this->endpoint->getByIdentifier($identifier);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/user-blocks');
    expect($this->api->getRequestQuery(null))->toContain('identifier=' . $identifier);
})->with(['mocked identifier' => [
    fn() => uniqid(),
]]);

test('deleteByIdentifier() issues an appropriate request', function(string $identifier): void {
    $this->endpoint->deleteByIdentifier($identifier);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/user-blocks');
    expect($this->api->getRequestQuery(null))->toContain('identifier=' . $identifier);
})->with(['mocked identifier' => [
    fn() => uniqid(),
]]);
