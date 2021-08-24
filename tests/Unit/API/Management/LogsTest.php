<?php

declare(strict_types=1);

uses()->group('management', 'management.logs');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->logs();
});

test('getAll() issues valid requests', function(): void {
    $this->endpoint->getAll();

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/logs', $this->api->getRequestUrl());
});

test('get() issues valid requests', function(): void {
    $logId = uniqid();

    $this->endpoint->get($logId);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/logs/' . $logId, $this->api->getRequestUrl());
});
