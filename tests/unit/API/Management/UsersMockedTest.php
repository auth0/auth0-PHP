<?php

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\API\Management;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use Auth0\SDK\Exception\InvalidPermissionsArrayException;
use Auth0\Tests\Traits\ErrorHelpers;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class UsersMockedTest.
 */
class UsersMockedTest extends TestCase
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
     * Test getAll() request.
     *
     * @return void
     */
    public function testGetAll()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = uniqid();

        $api->call()->users()->getAll(['test' => $mockup]);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/users', $api->getHistoryUrl());

        $query = '&' . $api->getHistoryQuery();
        $this->assertStringContainsString('&test=' . $mockup, $query);
    }

    /**
     * Test get() request.
     *
     * @return void
     */
    public function testGet()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockupId = uniqid();

        $api->call()->users()->get($mockupId);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockupId, $api->getHistoryUrl());
    }

    /**
     * Test update() request.
     *
     * @return void
     */
    public function testUpdate()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'query' => [
                'given_name' => uniqid(),
                'user_metadata' => [
                    '__test_meta_key__' => uniqid(),
                ],
            ]
        ];

        $api->call()->users()->update(
            $mockup->id,
            $mockup->query
        );

        $this->assertEquals('PATCH', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id, $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('given_name', $body);
        $this->assertEquals($mockup->query['given_name'], $body['given_name']);
        $this->assertArrayHasKey('user_metadata', $body);
        $this->assertArrayHasKey('__test_meta_key__', $body['user_metadata']);
        $this->assertEquals($mockup->query['user_metadata']['__test_meta_key__'], $body['user_metadata']['__test_meta_key__']);
    }

    /**
     * Test create() request.
     *
     * @return void
     */
    public function testCreate()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'connection' => uniqid(),
            'query' => [
                'email' => uniqid(),
                'password' => uniqid()
            ]
        ];

        $api->call()->users()->create(
            $mockup->connection,
            $mockup->query
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/users', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('connection', $body);
        $this->assertEquals($mockup->connection, $body['connection']);
        $this->assertArrayHasKey('email', $body);
        $this->assertEquals($mockup->query['email'], $body['email']);
        $this->assertArrayHasKey('password', $body);
        $this->assertEquals($mockup->query['password'], $body['password']);
    }

    /**
     * Test delete() request.
     *
     * @return void
     */
    public function testDelete()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockupId = uniqid();

        $api->call()->users()->delete($mockupId);

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockupId, $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }

    /**
     * Test linkAccount() request.
     *
     * @return void
     */
    public function testLinkAccount()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'query' => [
                'provider' => uniqid(),
                'connection_id' => uniqid(),
                'user_id' => uniqid(),
            ]
        ];

        $api->call()->users()->linkAccount(
            $mockup->id,
            $mockup->query
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockup->id . '/identities', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('provider', $body);
        $this->assertEquals($mockup->query['provider'], $body['provider']);
        $this->assertArrayHasKey('connection_id', $body);
        $this->assertEquals($mockup->query['connection_id'], $body['connection_id']);
        $this->assertArrayHasKey('user_id', $body);
        $this->assertEquals($mockup->query['user_id'], $body['user_id']);
    }

    /**
     * Test unlinkAccount() request.
     *
     * @return void
     */
    public function testUnlinkAccount()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'provider' => uniqid(),
            'identity' => uniqid()
        ];

        $api->call()->users()->unlinkAccount(
            $mockup->id,
            $mockup->provider,
            $mockup->identity
        );

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/users/' . $mockup->id . '/identities/' . $mockup->provider . '/' . $mockup->identity,
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }

    /**
     * Test deleteMultifactorProvider() request.
     *
     * @return void
     */
    public function testDeleteMultifactorProvider()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'provider' => uniqid()
        ];

        $api->call()->users()->deleteMultifactorProvider($mockup->id, $mockup->provider);

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/users/' . $mockup->id . '/multifactor/' . $mockup->provider,
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }

    /**
     * Test getRoles() request.
     *
     * @return void
     */
    public function testThatGetRolesRequestIsFormattedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockupId = uniqid();

        $api->call()->users()->getRoles($mockupId);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith(
            'https://api.test.local/api/v2/users/' . $mockupId . '/roles',
            $api->getHistoryUrl()
        );
    }

    /**
     * Test removeRoles() request.
     *
     * @return void
     */
    public function testRemoveRoles()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'roles' => [
                uniqid(),
                uniqid()
            ]
        ];

        $api->call()->users()->removeRoles($mockup->id, $mockup->roles);

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/users/' . $mockup->id . '/roles',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('roles', $body);
        $this->assertCount(2, $body['roles']);
        $this->assertEquals($mockup->roles[0], $body['roles'][0]);
        $this->assertEquals($mockup->roles[1], $body['roles'][1]);
    }

    /**
     * Test addRoles() request.
     *
     * @return void
     */
    public function testAddRoles()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'roles' => [
                uniqid(),
                uniqid()
            ]
        ];

        $api->call()->users()->addRoles($mockup->id, $mockup->roles);

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/users/' . $mockup->id . '/roles',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('roles', $body);
        $this->assertCount(2, $body['roles']);
        $this->assertEquals($mockup->roles[0], $body['roles'][0]);
        $this->assertEquals($mockup->roles[1], $body['roles'][1]);
    }

    /**
     * Test getEnrollments() request.
     *
     * @return void
     */
    public function testGetEnrollments()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockupId = uniqid();

        $api->call()->users()->getEnrollments($mockupId);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/users/' . $mockupId . '/enrollments',
            $api->getHistoryUrl()
        );
    }

    /**
     * Test getPermissions() request.
     *
     * @return void
     */
    public function testGetPermissions()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockupId = uniqid();

        $api->call()->users()->getPermissions($mockupId);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith(
            'https://api.test.local/api/v2/users/' . $mockupId . '/permissions',
            $api->getHistoryUrl()
        );
    }

    /**
     * Test removePermissions() request.
     *
     * @return void
     */
    public function testRemovePermissions()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'permissions' => [
                [
                    'permission_name' => 'test:' . uniqid(),
                    'resource_server_identifier' => uniqid(),
                ]
            ]
        ];

        $api->call()->users()->removePermissions(
            $mockup->id,
            $mockup->permissions
        );

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/users/' . $mockup->id . '/permissions',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('permissions', $body);
        $this->assertCount(1, $body['permissions']);
        $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
        $this->assertEquals($mockup->permissions[0]['permission_name'], $body['permissions'][0]['permission_name']);
        $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
        $this->assertEquals($mockup->permissions[0]['resource_server_identifier'], $body['permissions'][0]['resource_server_identifier']);
    }

    /**
     * Test addPermissions() request.
     *
     * @return void
     */
    public function testThatAddPermissionsRequestIsFormattedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'permissions' => [
                [
                    'permission_name' => 'test:' . uniqid(),
                    'resource_server_identifier' => uniqid(),
                ]
            ]
        ];

        $api->call()->users()->addPermissions(
            $mockup->id,
            $mockup->permissions
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/users/' . $mockup->id . '/permissions',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('permissions', $body);
        $this->assertCount(1, $body['permissions']);
        $this->assertArrayHasKey('permission_name', $body['permissions'][0]);
        $this->assertEquals($mockup->permissions[0]['permission_name'], $body['permissions'][0]['permission_name']);
        $this->assertArrayHasKey('resource_server_identifier', $body['permissions'][0]);
        $this->assertEquals($mockup->permissions[0]['resource_server_identifier'], $body['permissions'][0]['resource_server_identifier']);
    }

    /**
     * Test getLogs() request.
     *
     * @return void
     */
    public function testGetLogs()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockupId = uniqid();

        $api->call()->users()->getLogs($mockupId);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith(
            'https://api.test.local/api/v2/users/' . $mockupId . '/logs',
            $api->getHistoryUrl()
        );
    }

    /**
     * Test getOrganizations() request.
     *
     * @return void
     */
    public function testGetOrganizations()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockupId = uniqid();

        $api->call()->users()->getOrganizations($mockupId);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith(
            'https://api.test.local/api/v2/users/' . $mockupId . '/organizations',
            $api->getHistoryUrl()
        );
    }

    /**
     * Test createRecoveryCode() request.
     *
     * @return void
     */
    public function testThatCreateRecoveryCodeRequestIsFormattedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockupId = uniqid();

        $api->call()->users()->createRecoveryCode($mockupId);

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/users/' . $mockupId . '/recovery-code-regeneration',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }

    /**
     * Test invalidateBrowsers() request.
     *
     * @return void
     */
    public function testInvalidateBrowsers()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockupId = uniqid();

        $api->call()->users()->invalidateBrowsers($mockupId);

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/users/' . $mockupId . '/multifactor/actions/invalidate-remember-browser',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }
}
