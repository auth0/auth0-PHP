<?php

declare(strict_types=1);

uses()->group('management', 'management.grants');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->grants();
});

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll();

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/grants', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
});

test('getAllByClientId() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getAllByClientId($id);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/grants', $this->api->getRequestUrl());
    $this->assertEquals('client_id=' . $id, $this->api->getRequestQuery(null));
});

test('getAllByAudience() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getAllByAudience($id);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/grants', $this->api->getRequestUrl());
    $this->assertEquals('audience=' . $id, $this->api->getRequestQuery(null));
});

test('getAllByUserId() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getAllByUserId($id);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/grants', $this->api->getRequestUrl());
    $this->assertEquals('user_id=' . $id, $this->api->getRequestQuery(null));
});

test('delete() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->delete($id);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/grants/' . $id, $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
});
