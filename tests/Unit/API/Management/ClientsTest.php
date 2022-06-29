<?php

declare(strict_types=1);

uses()->group('management', 'management.clients');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->clients();
});

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll(['client_id' => '__test_client_id__', 'app_type' => '__test_app_type__']);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/clients');

    $query = $this->api->getRequestQuery();
    expect($query)->toContain('&client_id=__test_client_id__&app_type=__test_app_type__');
});

test('get() issues an appropriate request', function(): void {
    $this->endpoint->get('__test_id__');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/clients/__test_id__');
});

test('delete() issues an appropriate request', function(): void {
    $this->endpoint->delete('__test_id__');

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/clients/__test_id__');
});

test('create() issues an appropriate request', function(): void {
    $mock = (object) [
        'name' => uniqid(),
        'body'=> [
            'app_type' => uniqid()
        ]
    ];

    $this->endpoint->create($mock->name, $mock->body);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/clients');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual($mock->name);
    $this->assertArrayHasKey('app_type', $body);
    expect($body['app_type'])->toEqual($mock->body['app_type']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(array_merge(['name' => $mock->name], $mock->body)));
});

test('update() issues an appropriate request', function(): void {
    $this->endpoint->update('__test_id__', ['name' => '__test_new_name__']);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/clients/__test_id__');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual('__test_new_name__');
});
