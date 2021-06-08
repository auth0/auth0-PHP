<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

/**
 * Class UsersTest.
 */
class UsersTest extends TestCase
{
    /**
     * Test getAll() request.
     */
    public function testGetAll(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $api->mock()->users()->getAll(['test' => $id]);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/users', $api->getRequestUrl());

        $query = $api->getRequestQuery();
        $this->assertStringContainsString('&test=' . $id, $query);
    }

    /**
     * Test get() request.
     */
    public function testGet(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $api->mock()->users()->get($id);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $id, $api->getRequestUrl());
    }

    /**
     * Test update() request.
     */
    public function testUpdate(): void
    {
        $mockup = (object) [
            'id' => uniqid(),
            'query' => [
                'given_name' => uniqid(),
                'user_metadata' => [
                    '__test_meta_key__' => uniqid(),
                ],
            ],
        ];

        $api = new MockManagementApi();
        $api->mock()->users()->update($mockup->id, $mockup->query);

        $this->assertEquals('PATCH', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id, $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('given_name', $body);
        $this->assertEquals($mockup->query['given_name'], $body['given_name']);
        $this->assertArrayHasKey('user_metadata', $body);
        $this->assertArrayHasKey('__test_meta_key__', $body['user_metadata']);
        $this->assertEquals($mockup->query['user_metadata']['__test_meta_key__'], $body['user_metadata']['__test_meta_key__']);
    }

    /**
     * Test create() request.
     */
    public function testCreate(): void
    {
        $mockup = (object) [
            'connection' => uniqid(),
            'query' => [
                'email' => uniqid(),
                'password' => uniqid(),
            ],
        ];

        $api = new MockManagementApi();
        $api->mock()->users()->create($mockup->connection, $mockup->query);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('connection', $body);
        $this->assertEquals($mockup->connection, $body['connection']);
        $this->assertArrayHasKey('email', $body);
        $this->assertEquals($mockup->query['email'], $body['email']);
        $this->assertArrayHasKey('password', $body);
        $this->assertEquals($mockup->query['password'], $body['password']);
    }

    /**
     * Test delete() request.
     */
    public function testDelete(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $api->mock()->users()->delete($id);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $id, $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }

    /**
     * Test linkAccount() request.
     */
    public function testLinkAccount(): void
    {
        $mockup = (object) [
            'id' => uniqid(),
            'query' => [
                'provider' => uniqid(),
                'connection_id' => uniqid(),
                'user_id' => uniqid(),
            ],
        ];

        $api = new MockManagementApi();
        $api->mock()->users()->linkAccount($mockup->id, $mockup->query);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/identities', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('provider', $body);
        $this->assertEquals($mockup->query['provider'], $body['provider']);
        $this->assertArrayHasKey('connection_id', $body);
        $this->assertEquals($mockup->query['connection_id'], $body['connection_id']);
        $this->assertArrayHasKey('user_id', $body);
        $this->assertEquals($mockup->query['user_id'], $body['user_id']);
    }

    /**
     * Test unlinkAccount() request.
     */
    public function testUnlinkAccount(): void
    {
        $mockup = (object) [
            'id' => uniqid(),
            'provider' => uniqid(),
            'identity' => uniqid(),
        ];

        $api = new MockManagementApi();
        $api->mock()->users()->unlinkAccount($mockup->id, $mockup->provider, $mockup->identity);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/identities/' . $mockup->provider . '/' . $mockup->identity, $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }

    /**
     * Test deleteMultifactorProvider() request.
     */
    public function testDeleteMultifactorProvider(): void
    {
        $mockup = (object) [
            'id' => uniqid(),
            'provider' => uniqid(),
        ];

        $api = new MockManagementApi();
        $api->mock()->users()->deleteMultifactorProvider($mockup->id, $mockup->provider);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/multifactor/' . $mockup->provider, $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }

    /**
     * Test getRoles() request.
     */
    public function testThatGetRolesRequestIsFormattedProperly(): void
    {
        $mockupId = uniqid();

        $api = new MockManagementApi();
        $api->mock()->users()->getRoles($mockupId);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/users/' . $mockupId . '/roles', $api->getRequestUrl());
    }

    /**
     * Test removeRoles() request.
     */
    public function testRemoveRoles(): void
    {
        $mockup = (object) [
            'id' => uniqid(),
            'roles' => [
                uniqid(),
                uniqid(),
            ],
        ];

        $api = new MockManagementApi();
        $api->mock()->users()->removeRoles($mockup->id, $mockup->roles);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/roles', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('roles', $body);
        $this->assertCount(2, $body['roles']);
        $this->assertEquals($mockup->roles[0], $body['roles'][0]);
        $this->assertEquals($mockup->roles[1], $body['roles'][1]);
    }

    /**
     * Test addRoles() request.
     */
    public function testAddRoles(): void
    {
        $mockup = (object) [
            'id' => uniqid(),
            'roles' => [
                uniqid(),
                uniqid(),
            ],
        ];

        $api = new MockManagementApi();
        $api->mock()->users()->addRoles($mockup->id, $mockup->roles);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/roles', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('roles', $body);
        $this->assertCount(2, $body['roles']);
        $this->assertEquals($mockup->roles[0], $body['roles'][0]);
        $this->assertEquals($mockup->roles[1], $body['roles'][1]);
    }

    /**
     * Test getEnrollments() request.
     */
    public function testGetEnrollments(): void
    {
        $mockupId = uniqid();

        $api = new MockManagementApi();
        $api->mock()->users()->getEnrollments($mockupId);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockupId . '/enrollments', $api->getRequestUrl());
    }

    /**
     * Test getPermissions() request.
     */
    public function testGetPermissions(): void
    {
        $mockupId = uniqid();

        $api = new MockManagementApi();
        $api->mock()->users()->getPermissions($mockupId);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/users/' . $mockupId . '/permissions', $api->getRequestUrl());
    }

    /**
     * Test removePermissions() request.
     */
    public function testRemovePermissions(): void
    {
        $mockup = (object) [
            'id' => uniqid(),
            'permissions' => [
                [
                    'permission_name' => 'test:' . uniqid(),
                    'resource_server_identifier' => uniqid(),
                ],
            ],
        ];

        $api = new MockManagementApi();
        $api->mock()->users()->removePermissions($mockup->id, $mockup->permissions);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/permissions', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('permissions', $body);
        $this->assertCount(1, $body['permissions']);
        $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
        $this->assertEquals($mockup->permissions[0]['permission_name'], $body['permissions'][0]['permission_name']);
        $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
        $this->assertEquals($mockup->permissions[0]['resource_server_identifier'], $body['permissions'][0]['resource_server_identifier']);
    }

    /**
     * Test addPermissions() request.
     */
    public function testThatAddPermissionsRequestIsFormattedProperly(): void
    {
        $mockup = (object) [
            'id' => uniqid(),
            'permissions' => [
                [
                    'permission_name' => 'test:' . uniqid(),
                    'resource_server_identifier' => uniqid(),
                ],
            ],
        ];

        $api = new MockManagementApi();
        $api->mock()->users()->addPermissions($mockup->id, $mockup->permissions);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/permissions', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('permissions', $body);
        $this->assertCount(1, $body['permissions']);
        $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
        $this->assertEquals($mockup->permissions[0]['permission_name'], $body['permissions'][0]['permission_name']);
        $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
        $this->assertEquals($mockup->permissions[0]['resource_server_identifier'], $body['permissions'][0]['resource_server_identifier']);
    }

    /**
     * Test getLogs() request.
     */
    public function testGetLogs(): void
    {
        $mockupId = uniqid();

        $api = new MockManagementApi();
        $api->mock()->users()->getLogs($mockupId);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/users/' . $mockupId . '/logs', $api->getRequestUrl());
    }

    /**
     * Test getOrganizations() request.
     */
    public function testGetOrganizations(): void
    {
        $mockupId = uniqid();

        $api = new MockManagementApi();
        $api->mock()->users()->getOrganizations($mockupId);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/users/' . $mockupId . '/organizations', $api->getRequestUrl());
    }

    /**
     * Test createRecoveryCode() request.
     */
    public function testThatCreateRecoveryCodeRequestIsFormattedProperly(): void
    {
        $mockupId = uniqid();

        $api = new MockManagementApi();
        $api->mock()->users()->createRecoveryCode($mockupId);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockupId . '/recovery-code-regeneration', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }

    /**
     * Test invalidateBrowsers() request.
     */
    public function testInvalidateBrowsers(): void
    {
        $mockupId = uniqid();

        $api = new MockManagementApi();
        $api->mock()->users()->invalidateBrowsers($mockupId);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockupId . '/multifactor/actions/invalidate-remember-browser', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }
}
