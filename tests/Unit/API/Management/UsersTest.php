<?php

declare(strict_types=1);

uses()->group('management', 'management.users');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->users();
});

test('getAll() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getAll(['test' => $id]);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/users', $this->api->getRequestUrl());

    $query = $this->api->getRequestQuery();
    $this->assertStringContainsString('&test=' . $id, $query);
});

test('get() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->get($id);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $id, $this->api->getRequestUrl());
});

test('update() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'query' => [
            'given_name' => uniqid(),
            'user_metadata' => [
                '__test_meta_key__' => uniqid(),
            ],
        ],
    ];

    $this->endpoint->update($mockup->id, $mockup->query);

    $this->assertEquals('PATCH', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id, $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('given_name', $body);
    $this->assertEquals($mockup->query['given_name'], $body['given_name']);
    $this->assertArrayHasKey('user_metadata', $body);
    $this->assertArrayHasKey('__test_meta_key__', $body['user_metadata']);
    $this->assertEquals($mockup->query['user_metadata']['__test_meta_key__'], $body['user_metadata']['__test_meta_key__']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode($mockup->query), $body);
});

test('create() issues an appropriate request', function(): void {
    $mockup = (object) [
        'connection' => uniqid(),
        'query' => [
            'email' => uniqid(),
            'password' => uniqid(),
        ],
    ];

    $this->endpoint->create($mockup->connection, $mockup->query);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users', $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('connection', $body);
    $this->assertEquals($mockup->connection, $body['connection']);
    $this->assertArrayHasKey('email', $body);
    $this->assertEquals($mockup->query['email'], $body['email']);
    $this->assertArrayHasKey('password', $body);
    $this->assertEquals($mockup->query['password'], $body['password']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(array_merge(['connection' => $mockup->connection], $mockup->query)), $body);
});

test('delete() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->delete($id);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $id, $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);
});

test('linkAccount() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'query' => [
            'provider' => uniqid(),
            'connection_id' => uniqid(),
            'user_id' => uniqid(),
        ],
    ];

    $this->endpoint->linkAccount($mockup->id, $mockup->query);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/identities', $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('provider', $body);
    $this->assertEquals($mockup->query['provider'], $body['provider']);
    $this->assertArrayHasKey('connection_id', $body);
    $this->assertEquals($mockup->query['connection_id'], $body['connection_id']);
    $this->assertArrayHasKey('user_id', $body);
    $this->assertEquals($mockup->query['user_id'], $body['user_id']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode($mockup->query), $body);
});

test('unlinkAccount() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'provider' => uniqid(),
        'identity' => uniqid(),
    ];

    $this->endpoint->unlinkAccount($mockup->id, $mockup->provider, $mockup->identity);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/identities/' . $mockup->provider . '/' . $mockup->identity, $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);
});

test('deleteMultifactorProvider() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'provider' => uniqid(),
    ];

    $this->endpoint->deleteMultifactorProvider($mockup->id, $mockup->provider);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/multifactor/' . $mockup->provider, $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);
});

test('getRoles() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->getRoles($mockupId);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/users/' . $mockupId . '/roles', $this->api->getRequestUrl());
});

test('removeRoles() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'roles' => [
            uniqid(),
            uniqid(),
        ],
    ];

    $this->endpoint->removeRoles($mockup->id, $mockup->roles);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/roles', $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('roles', $body);
    $this->assertCount(2, $body['roles']);
    $this->assertEquals($mockup->roles[0], $body['roles'][0]);
    $this->assertEquals($mockup->roles[1], $body['roles'][1]);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals('{"roles":' . json_encode($mockup->roles) . '}', $body);
});

test('addRoles() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'roles' => [
            uniqid(),
            uniqid(),
        ],
    ];

    $this->endpoint->addRoles($mockup->id, $mockup->roles);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/roles', $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('roles', $body);
    $this->assertCount(2, $body['roles']);
    $this->assertEquals($mockup->roles[0], $body['roles'][0]);
    $this->assertEquals($mockup->roles[1], $body['roles'][1]);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals('{"roles":' . json_encode($mockup->roles) . '}', $body);
});

test('getEnrollments() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->getEnrollments($mockupId);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $mockupId . '/enrollments', $this->api->getRequestUrl());
});

test('getPermissions() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->getPermissions($mockupId);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/users/' . $mockupId . '/permissions', $this->api->getRequestUrl());
});

test('removePermissions() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'permissions' => [
            [
                'permission_name' => 'test:' . uniqid(),
                'resource_server_identifier' => uniqid(),
            ],
        ],
    ];

    $this->endpoint->removePermissions($mockup->id, $mockup->permissions);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/permissions', $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('permissions', $body);
    $this->assertCount(1, $body['permissions']);
    $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
    $this->assertEquals($mockup->permissions[0]['permission_name'], $body['permissions'][0]['permission_name']);
    $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
    $this->assertEquals($mockup->permissions[0]['resource_server_identifier'], $body['permissions'][0]['resource_server_identifier']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals('{"permissions":' . json_encode($mockup->permissions) . '}', $body);
});

test('addPermissions() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'permissions' => [
            [
                'permission_name' => 'test:' . uniqid(),
                'resource_server_identifier' => uniqid(),
            ],
        ],
    ];

    $this->endpoint->addPermissions($mockup->id, $mockup->permissions);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/permissions', $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('permissions', $body);
    $this->assertCount(1, $body['permissions']);
    $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
    $this->assertEquals($mockup->permissions[0]['permission_name'], $body['permissions'][0]['permission_name']);
    $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
    $this->assertEquals($mockup->permissions[0]['resource_server_identifier'], $body['permissions'][0]['resource_server_identifier']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals('{"permissions":' . json_encode($mockup->permissions) . '}', $body);
});

test('getLogs() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->getLogs($mockupId);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/users/' . $mockupId . '/logs', $this->api->getRequestUrl());
});

test('getOrganizations() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->getOrganizations($mockupId);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/users/' . $mockupId . '/organizations', $this->api->getRequestUrl());
});

test('createRecoveryCode() issues an appropriate request', function(): void {
        $mockupId = uniqid();

    $this->endpoint->createRecoveryCode($mockupId);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $mockupId . '/recovery-code-regeneration', $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);
});

test('invalidateBrowsers() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->invalidateBrowsers($mockupId);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/users/' . $mockupId . '/multifactor/actions/invalidate-remember-browser', $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);
});
