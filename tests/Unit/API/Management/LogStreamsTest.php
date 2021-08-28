<?php

declare(strict_types=1);

uses()->group('management', 'management.log_streams');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->logStreams();
});

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll();

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/log-streams', $this->api->getRequestUrl());
});

test('get() issues an appropriate request', function(): void {
    $this->endpoint->get('123');

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/log-streams/123', $this->api->getRequestUrl());
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

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/log-streams', $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertEquals($mock->name, $body['name']);
    $this->assertArrayHasKey('type', $body);
    $this->assertEquals($mock->type, $body['type']);
    $this->assertArrayHasKey('sink', $body);
    $this->assertEquals($mock->sink, $body['sink']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode($mock), $body);
});

test('update() issues an appropriate request', function(): void {
    $mock = (object) [
        'id' => uniqid(),
        'body' => [
            'name' => uniqid()
        ]
    ];

    $this->endpoint->update($mock->id, $mock->body);

    $this->assertEquals('PATCH', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/log-streams/' . $mock->id, $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertEquals($mock->body['name'], $body['name']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode($mock->body), $body);
});

test('delete() issues an appropriate request', function(): void {
    $this->endpoint->delete('123');

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/log-streams/123', $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);
});
