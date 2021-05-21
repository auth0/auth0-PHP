<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

/**
 * Class RolesTestMocked.
 */
class RolesMockedTest extends TestCase
{
    /**
     * Test a basic getAll roles call.
     */
    public function testGetAll(): void
    {
        $api = new MockManagementApi();
        $request = $api->mock()->roles()->getAll(['name_filter' => '__test_name_filter__']);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/roles', $api->getRequestUrl());

        $query = $api->getRequestQuery();
        $this->assertStringContainsString('name_filter=__test_name_filter__', $query);
    }

    /**
     * Test create role is requested properly.
     */
    public function testCreate(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->roles()->create($id, ['description' => '__test_description__']);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles', $api->getRequestUrl());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals($id, $body['name']);
        $this->assertArrayHasKey('description', $body);
        $this->assertEquals('__test_description__', $body['description']);
    }

    /**
     * Test a get role call.
     */
    public function testGet(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->roles()->get($id);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles/' . $id, $api->getRequestUrl());
    }

    /**
     * Test a delete role call.
     */
    public function testDelete(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->roles()->delete($id);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles/' . $id, $api->getRequestUrl());
    }

    /**
     * Test an update role call.
     */
    public function testUpdate(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->roles()->update($id, ['name' => '__test_new_name__']);

        $this->assertEquals('PATCH', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles/' . $id, $api->getRequestUrl());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals('__test_new_name__', $body['name']);
    }

    /**
     * Test a get role permissions call.
     */
    public function testGetPermissions(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->roles()->getPermissions($id);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/roles/' . $id . '/permissions', $api->getRequestUrl());
    }

    /**
     * Test an add role permissions call.
     */
    public function testAddPermissions(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->roles()->addPermissions($id, [
            [
                'permission_name' => '__test_permission_name__',
                'resource_server_identifier' => '__test_server_id__',
            ],
        ]);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles/' . $id . '/permissions', $api->getRequestUrl());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('permissions', $body);
        $this->assertCount(1, $body['permissions']);
        $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
        $this->assertEquals('__test_permission_name__', $body['permissions'][0]['permission_name']);
        $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
        $this->assertEquals('__test_server_id__', $body['permissions'][0]['resource_server_identifier']);
    }

    /**
     * Test a delete role permissions call.
     */
    public function testRemovePermissions(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->roles()->removePermissions($id, [
            [
                'permission_name' => '__test_permission_name__',
                'resource_server_identifier' => '__test_server_id__',
            ],
        ]);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles/' . $id . '/permissions', $api->getRequestUrl());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('permissions', $body);
        $this->assertCount(1, $body['permissions']);
        $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
        $this->assertEquals('__test_permission_name__', $body['permissions'][0]['permission_name']);
        $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
        $this->assertEquals('__test_server_id__', $body['permissions'][0]['resource_server_identifier']);
    }

    /**
     * Test a paginated get role users call.
     */
    public function testGetUsers(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->roles()->getUsers($id);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/roles/' . $id . '/users', $api->getRequestUrl());
    }

    /**
     * Test an add role user call.
     */
    public function testAddUsers(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->roles()->addUsers($id, ['strategy|1234567890', 'strategy|0987654321']);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles/' .$id . '/users', $api->getRequestUrl());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('users', $body);
        $this->assertCount(2, $body['users']);
        $this->assertContains('strategy|1234567890', $body['users']);
        $this->assertContains('strategy|0987654321', $body['users']);
    }
}
