<?php

declare(strict_types=1);

uses()->group('management', 'management.connections');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->connections();
});

test('getAll() issues an appropriate request', function(): void {
    $strategy = uniqid();

    $this->endpoint->getAll([ 'strategy' => $strategy ]);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringContainsString('https://api.test.local/api/v2/connections', $this->api->getRequestUrl());
    $this->assertStringContainsString('&strategy=' . $strategy, $this->api->getRequestQuery());
});

test('get() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->get($id);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/connections/' . $id, $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
});

test('delete() issues an appropriate request', function(): void {
    $id = 'con_testConnection10';

    $this->endpoint->delete($id);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/connections/' . $id, $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
});

test('deleteUser() issues an appropriate request', function(): void {
    $id = 'con_testConnection10';
    $email = 'con_testConnection10@auth0.com';

    $this->endpoint->deleteUser($id, $email);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertStringContainsString('https://api.test.local/api/v2/connections/' . $id . '/users', $this->api->getRequestUrl());
    $this->assertEquals('email=' . rawurlencode($email), $this->api->getRequestQuery(null));
});

test('create() issues an appropriate request', function(): void {
    $mock = (object) [
        'name' => uniqid(),
        'strategy' => uniqid(),
        'body' => [
            'test1' => uniqid(),
            'test2' => uniqid()
        ]
    ];

    $this->endpoint->create($mock->name, $mock->strategy, $mock->body);

    $request_body = $this->api->getRequestBody();

    $this->assertEquals($mock->name, $request_body['name']);
    $this->assertEquals($mock->strategy, $request_body['strategy']);
    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/connections', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(array_merge(['name' => $mock->name, 'strategy' => $mock->strategy], $mock->body)), $body);
});

test('update() issues an appropriate request', function(): void {
    $id = 'con_testConnection10';
    $update_data = ['metadata' => ['meta1' => 'value1']];

    $this->endpoint->update($id, $update_data);

    $request_body = $this->api->getRequestBody();

    $this->assertEquals($update_data, $request_body);
    $this->assertEquals('PATCH', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/connections/' . $id, $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
});
