<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class RolesTestMocked.
 */
class RolesMockedTest extends TestCase
{
    /**
     * Expected telemetry value.
     */
    protected static string $expectedTelemetry;

    /**
     * Default request headers.
     */
    protected static array $headers = ['content-type' => 'json'];

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass(): void
    {
        $infoHeadersData = new InformationHeaders();
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    /**
     * Test a basic getAll roles call.
     */
    public function testGetAll(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->roles()->getAll(['name_filter' => '__test_name_filter__', 'page' => 2]);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/roles', $api->getHistoryUrl());

        $query = $api->getHistoryQuery();
        $this->assertStringContainsString('page=2', $query);
        $this->assertStringContainsString('name_filter=__test_name_filter__', $query);
    }

    /**
     * Test create role is requested properly.
     */
    public function testCreate(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->roles()->create('__test_name__', ['description' => '__test_description__']);

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles', $api->getHistoryUrl());

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals('__test_name__', $body['name']);
        $this->assertArrayHasKey('description', $body);
        $this->assertEquals('__test_description__', $body['description']);
    }

    /**
     * Test a get role call.
     */
    public function testGet(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->roles()->get('__test_role_id__');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles/__test_role_id__', $api->getHistoryUrl());
    }

    /**
     * Test a delete role call.
     */
    public function testDelete(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->roles()->delete('__test_role_id__');

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles/__test_role_id__', $api->getHistoryUrl());
    }

    /**
     * Test an update role call.
     */
    public function testUpdate(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->roles()->update('__test_role_id__', ['name' => '__test_new_name__']);

        $this->assertEquals('PATCH', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles/__test_role_id__', $api->getHistoryUrl());

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals('__test_new_name__', $body['name']);
    }

    /**
     * Test a get role permissions call.
     */
    public function testGetPermissions(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->roles()->getPermissions('__test_role_id__');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith(
            'https://api.test.local/api/v2/roles/__test_role_id__/permissions',
            $api->getHistoryUrl()
        );
    }

    /**
     * Test an add role permissions call.
     */
    public function testAddPermissions(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->roles()->addPermissions(
            '__test_role_id__',
            [
                [
                    'permission_name' => '__test_permission_name__',
                    'resource_server_identifier' => '__test_server_id__',
                ],
            ]
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/roles/__test_role_id__/permissions',
            $api->getHistoryUrl()
        );

        $body = $api->getHistoryBody();
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
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->roles()->removePermissions(
            '__test_role_id__',
            [
                [
                    'permission_name' => '__test_permission_name__',
                    'resource_server_identifier' => '__test_server_id__',
                ],
            ]
        );

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/roles/__test_role_id__/permissions',
            $api->getHistoryUrl()
        );

        $body = $api->getHistoryBody();
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
        $api = new MockManagementApi(
            [
                new Response(200, self::$headers),
                new Response(200, self::$headers),
            ]
        );

        $api->call()->roles()->getUsers('__test_role_id__');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith(
            'https://api.test.local/api/v2/roles/__test_role_id__/users',
            $api->getHistoryUrl()
        );
    }

    /**
     * Test an add role user call.
     */
    public function testAddUsers(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->roles()->addUsers(
            '__test_role_id__',
            ['strategy|1234567890', 'strategy|0987654321']
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/roles/__test_role_id__/users',
            $api->getHistoryUrl()
        );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('users', $body);
        $this->assertCount(2, $body['users']);
        $this->assertContains('strategy|1234567890', $body['users']);
        $this->assertContains('strategy|0987654321', $body['users']);
    }
}
