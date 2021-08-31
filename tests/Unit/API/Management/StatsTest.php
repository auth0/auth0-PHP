<?php

declare(strict_types=1);

uses()->group('management', 'management.stats');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->stats();
});

test('getActiveUsers() issues an appropriate request', function(): void {
    $this->endpoint->getActiveUsers();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/stats/active-users');
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('getDaily() issues an appropriate request', function(string $from, string $to): void {
    $this->endpoint->getDaily($from, $to);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/stats/daily');
    expect($this->api->getRequestQuery(null))->toContain('from=' . $from);
    expect($this->api->getRequestQuery(null))->toContain('to=' . $to);
})->with(['mocked id' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);
