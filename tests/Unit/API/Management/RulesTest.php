<?php

declare(strict_types=1);

uses()->group('management', 'management.rules');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->rules();
});

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll(['enabled' => true]);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/rules', $this->api->getRequestUrl());

    $query = $this->api->getRequestQuery();
    $this->assertStringContainsString('enabled=true', $query);
});

test('get() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->get($mockupId);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/rules/' . $mockupId, $this->api->getRequestUrl());
});

test('delete() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->delete($mockupId);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/rules/' . $mockupId, $this->api->getRequestUrl());
});

test('create() issues an appropriate request', function(): void {
    $mockup = (object) [
        'name' => uniqid(),
        'script' => uniqid(),
        'query' => [ 'test_parameter' => uniqid() ],
    ];

    $this->endpoint->create($mockup->name, $mockup->script, $mockup->query);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/rules', $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertEquals($mockup->name, $body['name']);

    $this->assertArrayHasKey('script', $body);
    $this->assertEquals($mockup->script, $body['script']);

    $this->assertArrayHasKey('test_parameter', $body);
    $this->assertEquals($mockup->query['test_parameter'], $body['test_parameter']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(array_merge(['name' => $mockup->name, 'script' => $mockup->script], $mockup->query)), $body);
});

test('update() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'query' => [ 'test_parameter' => uniqid() ],
    ];

    $this->endpoint->update($mockup->id, $mockup->query);

    $this->assertEquals('PATCH', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/rules/' . $mockup->id, $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('test_parameter', $body);
    $this->assertEquals($mockup->query['test_parameter'], $body['test_parameter']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode($mockup->query), $body);
});
