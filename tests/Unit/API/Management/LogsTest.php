<?php

declare(strict_types=1);

uses()->group('management', 'management.logs');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->logs();
});

test('getAll() issues valid requests', function(): void {
    $this->endpoint->getAll();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/logs');
});

test('get() issues valid requests', function(): void {
    $logId = uniqid();

    $this->endpoint->get($logId);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/logs/' . $logId);
});
