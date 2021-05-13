<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class UsersMockedTest.
 */
class UsersMockedTest extends TestCase
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
     * Test getAll() request.
     */
    public function testGetAll(): void
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
     */
    public function testGet(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockupId = uniqid();

        $api->call()->users()->get($mockupId);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/users/' . $mockupId, $api->getHistoryUrl());
    }

    /**
     * Test update() request.
     */
    public function testUpdate(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'query' => [
                'given_name' => uniqid(),
                'user_metadata' => [
                    '__test_meta_key__' => uniqid(),
                ],
            ],
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
     */
    public function testCreate(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'connection' => uniqid(),
            'query' => [
                'email' => uniqid(),
                'password' => uniqid(),
            ],
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
     */
    public function testDelete(): void
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
     */
    public function testLinkAccount(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'query' => [
                'provider' => uniqid(),
                'connection_id' => uniqid(),
                'user_id' => uniqid(),
            ],
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
     */
    public function testUnlinkAccount(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'provider' => uniqid(),
            'identity' => uniqid(),
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
     */
    public function testDeleteMultifactorProvider(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'provider' => uniqid(),
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
     */
    public function testThatGetRolesRequestIsFormattedProperly(): void
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
     */
    public function testRemoveRoles(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'roles' => [
                uniqid(),
                uniqid(),
            ],
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
     */
    public function testAddRoles(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'roles' => [
                uniqid(),
                uniqid(),
            ],
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
     */
    public function testGetEnrollments(): void
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
     */
    public function testGetPermissions(): void
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
     */
    public function testRemovePermissions(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'permissions' => [
                [
                    'permission_name' => 'test:' . uniqid(),
                    'resource_server_identifier' => uniqid(),
                ],
            ],
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
     */
    public function testThatAddPermissionsRequestIsFormattedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'permissions' => [
                [
                    'permission_name' => 'test:' . uniqid(),
                    'resource_server_identifier' => uniqid(),
                ],
            ],
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
     */
    public function testGetLogs(): void
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
     */
    public function testGetOrganizations(): void
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
     */
    public function testThatCreateRecoveryCodeRequestIsFormattedProperly(): void
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
     */
    public function testInvalidateBrowsers(): void
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
