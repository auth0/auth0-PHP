<?php

declare(strict_types=1);

uses()->group('management', 'management.tenants');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->tenants();
});

test('get() issues an appropriate request', function(): void {
    $this->endpoint->getSettings();

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/tenants/settings', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
});

test('update() issues an appropriate request', function(array $body): void {
    $this->endpoint->updateSettings($body);

    $this->assertEquals('PATCH', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/tenants/settings', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());

    $request = $this->api->getRequestBody();
    $this->assertArrayHasKey('test', $request);
    $this->assertEquals($body['test'], $request['test']);

    $request = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode($body), $request);
})->with(['mocked data' => [
    fn() => [ 'test' => uniqid() ],
]]);
