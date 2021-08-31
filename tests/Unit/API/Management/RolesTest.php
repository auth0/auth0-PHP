<?php

declare(strict_types=1);

uses()->group('management', 'management.roles');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->roles();
});

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll(['name_filter' => '__test_name_filter__']);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/roles');

    $query = $this->api->getRequestQuery();
    expect($query)->toContain('name_filter=__test_name_filter__');
});

test('create() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->create($id, ['description' => '__test_description__']);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/roles');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual($id);
    $this->assertArrayHasKey('description', $body);
    expect($body['description'])->toEqual('__test_description__');

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['name' => $id, 'description' => '__test_description__']));
});

test('get() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->get($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/roles/' . $id);
});

test('delete() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->delete($id);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/roles/' . $id);
});

test('update() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->update($id, ['name' => '__test_new_name__']);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/roles/' . $id);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual('__test_new_name__');

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['name' => '__test_new_name__']));
});

test('getPermissions() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getPermissions($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/roles/' . $id . '/permissions');
});

test('addPermissions() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->addPermissions($id, [
        [
            'permission_name' => '__test_permission_name__',
            'resource_server_identifier' => '__test_server_id__',
        ],
    ]);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/roles/' . $id . '/permissions');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('permissions', $body);
    expect($body['permissions'])->toHaveCount(1);
    $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
    expect($body['permissions'][0]['permission_name'])->toEqual('__test_permission_name__');
    $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
    expect($body['permissions'][0]['resource_server_identifier'])->toEqual('__test_server_id__');
});

test('removePermissions() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->removePermissions($id, [
        [
            'permission_name' => '__test_permission_name__',
            'resource_server_identifier' => '__test_server_id__',
        ],
    ]);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/roles/' . $id . '/permissions');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('permissions', $body);
    expect($body['permissions'])->toHaveCount(1);
    $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
    expect($body['permissions'][0]['permission_name'])->toEqual('__test_permission_name__');
    $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
    expect($body['permissions'][0]['resource_server_identifier'])->toEqual('__test_server_id__');
});

test('getUsers() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getUsers($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/roles/' . $id . '/users');
});

test('addUsers() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->addUsers($id, ['strategy|1234567890', 'strategy|0987654321']);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/roles/' .$id . '/users');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('users', $body);
    expect($body['users'])->toHaveCount(2);
    expect($body['users'])->toContain('strategy|1234567890');
    expect($body['users'])->toContain('strategy|0987654321');

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['users' => ['strategy|1234567890', 'strategy|0987654321']]));
});
