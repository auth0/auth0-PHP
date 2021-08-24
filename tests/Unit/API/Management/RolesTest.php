<?php

declare(strict_types=1);

uses()->group('management', 'management.roles');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->roles();
});

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll(['name_filter' => '__test_name_filter__']);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/roles', $this->api->getRequestUrl());

    $query = $this->api->getRequestQuery();
    $this->assertStringContainsString('name_filter=__test_name_filter__', $query);
});

test('create() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->create($id, ['description' => '__test_description__']);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/roles', $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertEquals($id, $body['name']);
    $this->assertArrayHasKey('description', $body);
    $this->assertEquals('__test_description__', $body['description']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['name' => $id, 'description' => '__test_description__']), $body);
});

test('get() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->get($id);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/roles/' . $id, $this->api->getRequestUrl());
});

test('delete() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->delete($id);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/roles/' . $id, $this->api->getRequestUrl());
});

test('update() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->update($id, ['name' => '__test_new_name__']);

    $this->assertEquals('PATCH', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/roles/' . $id, $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertEquals('__test_new_name__', $body['name']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['name' => '__test_new_name__']), $body);
});

test('getPermissions() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getPermissions($id);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/roles/' . $id . '/permissions', $this->api->getRequestUrl());
});

test('addPermissions() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->addPermissions($id, [
        [
            'permission_name' => '__test_permission_name__',
            'resource_server_identifier' => '__test_server_id__',
        ],
    ]);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/roles/' . $id . '/permissions', $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('permissions', $body);
    $this->assertCount(1, $body['permissions']);
    $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
    $this->assertEquals('__test_permission_name__', $body['permissions'][0]['permission_name']);
    $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
    $this->assertEquals('__test_server_id__', $body['permissions'][0]['resource_server_identifier']);
});

test('removePermissions() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->removePermissions($id, [
        [
            'permission_name' => '__test_permission_name__',
            'resource_server_identifier' => '__test_server_id__',
        ],
    ]);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/roles/' . $id . '/permissions', $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('permissions', $body);
    $this->assertCount(1, $body['permissions']);
    $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
    $this->assertEquals('__test_permission_name__', $body['permissions'][0]['permission_name']);
    $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
    $this->assertEquals('__test_server_id__', $body['permissions'][0]['resource_server_identifier']);
});

test('getUsers() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getUsers($id);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/roles/' . $id . '/users', $this->api->getRequestUrl());
});

test('addUsers() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->addUsers($id, ['strategy|1234567890', 'strategy|0987654321']);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/roles/' .$id . '/users', $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('users', $body);
    $this->assertCount(2, $body['users']);
    $this->assertContains('strategy|1234567890', $body['users']);
    $this->assertContains('strategy|0987654321', $body['users']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['users' => ['strategy|1234567890', 'strategy|0987654321']]), $body);
});
