<?php

declare(strict_types=1);

uses()->group('management', 'management.clients');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->clients();
});

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll(['client_id' => '__test_client_id__', 'app_type' => '__test_app_type__']);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/clients', $this->api->getRequestUrl());

    $query = $this->api->getRequestQuery();
    $this->assertStringContainsString('&client_id=__test_client_id__&app_type=__test_app_type__', $query);
});

test('get() issues an appropriate request', function(): void {
    $this->endpoint->get('__test_id__');

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/clients/__test_id__', $this->api->getRequestUrl());
});

test('delete() issues an appropriate request', function(): void {
    $this->endpoint->delete('__test_id__');

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/clients/__test_id__', $this->api->getRequestUrl());
});

test('create() issues an appropriate request', function(): void {
    $mock = (object) [
        'name' => uniqid(),
        'body'=> [
            'app_type' => uniqid()
        ]
    ];

    $this->endpoint->create($mock->name, $mock->body);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/clients', $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertEquals($mock->name, $body['name']);
    $this->assertArrayHasKey('app_type', $body);
    $this->assertEquals($mock->body['app_type'], $body['app_type']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(array_merge(['name' => $mock->name], $mock->body)), $body);
});

test('update() issues an appropriate request', function(): void {
    $this->endpoint->update('__test_id__', ['name' => '__test_new_name__']);

    $this->assertEquals('PATCH', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/clients/__test_id__', $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertEquals('__test_new_name__', $body['name']);
});
