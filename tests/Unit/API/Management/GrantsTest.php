<?php

declare(strict_types=1);

uses()->group('management', 'management.grants');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->grants();
});

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/grants');
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('getAllByClientId() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getAllByClientId($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/grants');
    expect($this->api->getRequestQuery(null))->toEqual('client_id=' . $id);
});

test('getAllByAudience() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getAllByAudience($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/grants');
    expect($this->api->getRequestQuery(null))->toEqual('audience=' . $id);
});

test('getAllByUserId() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getAllByUserId($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/grants');
    expect($this->api->getRequestQuery(null))->toEqual('user_id=' . $id);
});

test('delete() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->delete($id);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/grants/' . $id);
    expect($this->api->getRequestQuery())->toBeEmpty();
});
