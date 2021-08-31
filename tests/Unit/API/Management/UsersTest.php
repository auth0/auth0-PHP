<?php

declare(strict_types=1);

uses()->group('management', 'management.users');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->users();
});

test('getAll() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getAll(['test' => $id]);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/users');

    $query = $this->api->getRequestQuery();
    expect($query)->toContain('&test=' . $id);
});

test('get() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->get($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $id);
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

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $mockup->id);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('given_name', $body);
    expect($body['given_name'])->toEqual($mockup->query['given_name']);
    $this->assertArrayHasKey('user_metadata', $body);
    $this->assertArrayHasKey('__test_meta_key__', $body['user_metadata']);
    expect($body['user_metadata']['__test_meta_key__'])->toEqual($mockup->query['user_metadata']['__test_meta_key__']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode($mockup->query));
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

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('connection', $body);
    expect($body['connection'])->toEqual($mockup->connection);
    $this->assertArrayHasKey('email', $body);
    expect($body['email'])->toEqual($mockup->query['email']);
    $this->assertArrayHasKey('password', $body);
    expect($body['password'])->toEqual($mockup->query['password']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(array_merge(['connection' => $mockup->connection], $mockup->query)));
});

test('delete() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->delete($id);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $id);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');
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

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $mockup->id . '/identities');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('provider', $body);
    expect($body['provider'])->toEqual($mockup->query['provider']);
    $this->assertArrayHasKey('connection_id', $body);
    expect($body['connection_id'])->toEqual($mockup->query['connection_id']);
    $this->assertArrayHasKey('user_id', $body);
    expect($body['user_id'])->toEqual($mockup->query['user_id']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode($mockup->query));
});

test('unlinkAccount() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'provider' => uniqid(),
        'identity' => uniqid(),
    ];

    $this->endpoint->unlinkAccount($mockup->id, $mockup->provider, $mockup->identity);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $mockup->id . '/identities/' . $mockup->provider . '/' . $mockup->identity);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');
});

test('deleteMultifactorProvider() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'provider' => uniqid(),
    ];

    $this->endpoint->deleteMultifactorProvider($mockup->id, $mockup->provider);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $mockup->id . '/multifactor/' . $mockup->provider);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');
});

test('getRoles() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->getRoles($mockupId);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/users/' . $mockupId . '/roles');
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

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $mockup->id . '/roles');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('roles', $body);
    expect($body['roles'])->toHaveCount(2);
    expect($body['roles'][0])->toEqual($mockup->roles[0]);
    expect($body['roles'][1])->toEqual($mockup->roles[1]);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual('{"roles":' . json_encode($mockup->roles) . '}');
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

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $mockup->id . '/roles');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('roles', $body);
    expect($body['roles'])->toHaveCount(2);
    expect($body['roles'][0])->toEqual($mockup->roles[0]);
    expect($body['roles'][1])->toEqual($mockup->roles[1]);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual('{"roles":' . json_encode($mockup->roles) . '}');
});

test('getEnrollments() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->getEnrollments($mockupId);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $mockupId . '/enrollments');
});

test('getPermissions() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->getPermissions($mockupId);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/users/' . $mockupId . '/permissions');
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

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $mockup->id . '/permissions');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('permissions', $body);
    expect($body['permissions'])->toHaveCount(1);
    $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
    expect($body['permissions'][0]['permission_name'])->toEqual($mockup->permissions[0]['permission_name']);
    $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
    expect($body['permissions'][0]['resource_server_identifier'])->toEqual($mockup->permissions[0]['resource_server_identifier']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual('{"permissions":' . json_encode($mockup->permissions) . '}');
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

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $mockup->id . '/permissions');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('permissions', $body);
    expect($body['permissions'])->toHaveCount(1);
    $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
    expect($body['permissions'][0]['permission_name'])->toEqual($mockup->permissions[0]['permission_name']);
    $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
    expect($body['permissions'][0]['resource_server_identifier'])->toEqual($mockup->permissions[0]['resource_server_identifier']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual('{"permissions":' . json_encode($mockup->permissions) . '}');
});

test('getLogs() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->getLogs($mockupId);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/users/' . $mockupId . '/logs');
});

test('getOrganizations() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->getOrganizations($mockupId);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/users/' . $mockupId . '/organizations');
});

test('createRecoveryCode() issues an appropriate request', function(): void {
        $mockupId = uniqid();

    $this->endpoint->createRecoveryCode($mockupId);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $mockupId . '/recovery-code-regeneration');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');
});

test('invalidateBrowsers() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->invalidateBrowsers($mockupId);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/users/' . $mockupId . '/multifactor/actions/invalidate-remember-browser');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');
});
