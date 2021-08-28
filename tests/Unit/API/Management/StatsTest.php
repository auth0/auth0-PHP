<?php

declare(strict_types=1);

uses()->group('management', 'management.stats');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->stats();
});

test('getActiveUsers() issues an appropriate request', function(): void {
    $this->endpoint->getActiveUsers();

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/stats/active-users', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
});

test('getDaily() issues an appropriate request', function(string $from, string $to): void {
    $this->endpoint->getDaily($from, $to);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/stats/daily', $this->api->getRequestUrl());
    $this->assertStringContainsString('from=' . $from, $this->api->getRequestQuery(null));
    $this->assertStringContainsString('to=' . $to, $this->api->getRequestQuery(null));
})->with(['mocked id' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);
