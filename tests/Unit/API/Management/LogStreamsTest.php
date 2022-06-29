<?php

declare(strict_types=1);

uses()->group('management', 'management.log_streams');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->logStreams();
});

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/log-streams');
});

test('get() issues an appropriate request', function(): void {
    $this->endpoint->get('123');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/log-streams/123');
});

test('create() issues an appropriate request', function(): void {
    $mock = (object) [
        'type' => uniqid(),
        'sink' => [
            'httpEndpoint' => uniqid(),
            'httpContentFormat' => uniqid(),
            'httpContentType' => uniqid(),
            'httpAuthorization' => uniqid(),
        ],
        'name' => uniqid(),
    ];

    $this->endpoint->create($mock->type, $mock->sink, $mock->name);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/log-streams');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual($mock->name);
    $this->assertArrayHasKey('type', $body);
    expect($body['type'])->toEqual($mock->type);
    $this->assertArrayHasKey('sink', $body);
    expect($body['sink'])->toEqual($mock->sink);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode($mock));
});

test('update() issues an appropriate request', function(): void {
    $mock = (object) [
        'id' => uniqid(),
        'body' => [
            'name' => uniqid()
        ]
    ];

    $this->endpoint->update($mock->id, $mock->body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/log-streams/' . $mock->id);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual($mock->body['name']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode($mock->body));
});

test('delete() issues an appropriate request', function(): void {
    $this->endpoint->delete('123');

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/log-streams/123');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');
});
