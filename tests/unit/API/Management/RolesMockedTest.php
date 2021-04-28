<?php

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\Tests\Traits\ErrorHelpers;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class RolesTestMocked.
 */
class RolesMockedTest extends TestCase
{
    use ErrorHelpers;

    /**
     * Expected telemetry value.
     *
     * @var string
     */
    protected static $expectedTelemetry;

    /**
     * Default request headers.
     *
     * @var array
     */
    protected static $headers = ['content-type' => 'json'];

    /**
     * Runs before test suite starts.
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        $infoHeadersData = new InformationHeaders();
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    /**
     * Test a basic getAll roles call.
     *
     * @return void
     */
    public function testGetAll()
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
     *
     * @return void
     */
    public function testCreate()
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
     *
     * @return void
     */
    public function testGet()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->roles()->get('__test_role_id__');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles/__test_role_id__', $api->getHistoryUrl());
    }

    /**
     * Test a delete role call.
     *
     * @return void
     */
    public function testDelete()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->roles()->delete('__test_role_id__');

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/roles/__test_role_id__', $api->getHistoryUrl());
    }

    /**
     * Test an update role call.
     *
     * @return void
     */
    public function testUpdate()
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
     *
     * @return void
     */
    public function testGetPermissions()
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
     *
     * @return void
     */
    public function testAddPermissions()
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
     *
     * @return void
     */
    public function testRemovePermissions()
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
     *
     * @return void
     */
    public function testGetUsers()
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
     *
     * @return void
     */
    public function testAddUsers()
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
