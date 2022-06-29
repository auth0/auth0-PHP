<?php

declare(strict_types=1);

uses()->group('management', 'management.tenants');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->tenants();
});

test('get() issues an appropriate request', function(): void {
    $this->endpoint->getSettings();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/tenants/settings');
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('update() issues an appropriate request', function(array $body): void {
    $this->endpoint->updateSettings($body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/tenants/settings');
    expect($this->api->getRequestQuery())->toBeEmpty();

    $request = $this->api->getRequestBody();
    $this->assertArrayHasKey('test', $request);
    expect($request['test'])->toEqual($body['test']);

    $request = $this->api->getRequestBodyAsString();
    expect($request)->toEqual(json_encode($body));
})->with(['mocked data' => [
    fn() => [ 'test' => uniqid() ],
]]);
