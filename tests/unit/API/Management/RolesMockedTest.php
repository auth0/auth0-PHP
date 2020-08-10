<?php
namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use Auth0\SDK\Exception\InvalidPermissionsArrayException;
use Auth0\Tests\Traits\ErrorHelpers;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class RolesTestMocked.
 *
 * @package Auth0\Tests\unit\API\Management
 */
class RolesTestMocked extends TestCase
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
    protected static $headers = [ 'content-type' => 'json' ];

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass()
    {
        $infoHeadersData = new InformationHeaders;
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    /**
     * Test a basic getAll roles call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllRolesRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->roles()->getAll( [ 'name_filter' => '__test_name_filter__', 'page' => 2 ] );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/roles', $api->getHistoryUrl() );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'page=2', $query );
        $this->assertContains( 'name_filter=__test_name_filter__', $query );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test that an empty role name throws an exception when trying to create a role.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatCreateRoleRequestWithEmptyNameThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->roles()->create( '' );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid name', $exception_message );
    }

    /**
     * Test create role is requested properly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatCreateRoleRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->roles()->create( '__test_name__', [ 'description' => '__test_description__' ] );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/roles', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'name', $body );
        $this->assertEquals( '__test_name__', $body['name'] );
        $this->assertArrayHasKey( 'description', $body );
        $this->assertEquals( '__test_description__', $body['description'] );
    }

    /**
     * Test that an empty role ID throws an exception when trying to get a role.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetRoleRequestWithEmptyRoleIdThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->roles()->get( '' );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid role_id', $exception_message );
    }

    /**
     * Test a get role call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetRoleRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->roles()->get( '__test_role_id__' );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/roles/__test_role_id__', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test that an empty role ID throws an exception when trying to delete a role.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatDeleteRoleRequestWithEmptyRoleIdThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->roles()->delete( '' );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid role_id', $exception_message );
    }

    /**
     * Test a delete role call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatDeleteRoleRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->roles()->delete( '__test_role_id__' );

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/roles/__test_role_id__', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test that an empty role ID throws an exception when trying to update a role.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatUpdateRoleRequestWithEmptyRoleIdThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->roles()->update( '', [] );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid role_id', $exception_message );
    }

    /**
     * Test an update role call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatUpdateRoleRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->roles()->update( '__test_role_id__', [ 'name' => '__test_new_name__' ] );

        $this->assertEquals( 'PATCH', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/roles/__test_role_id__', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'name', $body );
        $this->assertEquals( '__test_new_name__', $body['name'] );
    }

    /**
     * Test that an empty role ID throws an exception when trying to get permissions for a role.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetRolePermissionsRequestWithEmptyRoleIdThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->roles()->getPermissions( '' );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid role_id', $exception_message );
    }

    /**
     * Test a get role permissions call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetRolePermissionsRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->roles()->getPermissions( '__test_role_id__', [ 'page' => -3, 'per_page' => -6 ] );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith(
            'https://api.test.local/api/v2/roles/__test_role_id__/permissions',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'page=3', $query );
        $this->assertContains( 'per_page=6', $query );
    }

    /**
     * Test a get role permissions call including totals.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetRolePermissionsRequestIncludesTotals()
    {
        $api = new MockManagementApi( [
            new Response( 200, self::$headers ),
            new Response( 200, self::$headers ),
        ] );

        $api->call()->roles()->getPermissions( '__test_role_id__', [ 'include_totals' => false ] );

        $this->assertContains( 'include_totals=false', $api->getHistoryQuery() );

        $api->call()->roles()->getPermissions( '__test_role_id__', [ 'include_totals' => 1 ] );

        $this->assertContains( 'include_totals=true', $api->getHistoryQuery() );
    }

    /**
     * Test that an empty role ID throws an exception when trying to add permissions for a role.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatAddRolePermissionsRequestWithEmptyRoleIdThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->roles()->addPermissions( '', [] );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid role_id', $exception_message );
    }

    /**
     * Test that an invalid permissions array throws an exception when trying to add permissions for a role.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatAddRolePermissionsRequestWithEmptyPermissionsThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->roles()->addPermissions( '__test_role_id__', [] );
            $caught_exception = false;
        } catch (InvalidPermissionsArrayException $e) {
            $caught_exception = true;
        }

        $this->assertTrue( $caught_exception );
    }

    /**
     * Test an add role permissions call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatAddRolePermissionsRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->roles()->addPermissions(
            '__test_role_id__',
            [
                [
                    'permission_name' => '__test_permission_name__',
                    'resource_server_identifier' => '__test_server_id__',
                ]
            ]
        );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://api.test.local/api/v2/roles/__test_role_id__/permissions',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'permissions', $body );
        $this->assertCount( 1, $body['permissions'] );
        $this->assertArrayHasKey( 'permission_name', $body['permissions'][0] );
        $this->assertEquals( '__test_permission_name__', $body['permissions'][0]['permission_name'] );
        $this->assertArrayHasKey( 'resource_server_identifier', $body['permissions'][0] );
        $this->assertEquals( '__test_server_id__', $body['permissions'][0]['resource_server_identifier'] );
    }

    /**
     * Test that an empty role ID throws an exception when trying to delete permissions from a role.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatRemoveRolePermissionsRequestWithEmptyRoleIdThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->roles()->removePermissions( '', [] );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid role_id', $exception_message );
    }

    /**
     * Test that an invalid permissions array throws an exception when trying to delete permissions from a role.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatRemoveRolePermissionsRequestWithInvalidPermissionsThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->roles()->removePermissions(
                '__test_role_id__',
                [ [ 'permission_name' => uniqid() ] ]
            );
            $caught_exception = false;
        } catch (InvalidPermissionsArrayException $e) {
            $caught_exception = true;
        }

        $this->assertTrue( $caught_exception );

        try {
            $api->call()->roles()->removePermissions(
                '__test_role_id__',
                [ [ 'resource_server_identifier' => uniqid() ] ]
            );
            $caught_exception = false;
        } catch (InvalidPermissionsArrayException $e) {
            $caught_exception = true;
        }

        $this->assertTrue( $caught_exception );
    }

    /**
     * Test a delete role permissions call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatRemoveRolePermissionsRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->roles()->removePermissions(
            '__test_role_id__',
            [
                [
                    'permission_name' => '__test_permission_name__',
                    'resource_server_identifier' => '__test_server_id__',
                ]
            ]
        );

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://api.test.local/api/v2/roles/__test_role_id__/permissions',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'permissions', $body );
        $this->assertCount( 1, $body['permissions'] );
        $this->assertArrayHasKey( 'permission_name', $body['permissions'][0] );
        $this->assertEquals( '__test_permission_name__', $body['permissions'][0]['permission_name'] );
        $this->assertArrayHasKey( 'resource_server_identifier', $body['permissions'][0] );
        $this->assertEquals( '__test_server_id__', $body['permissions'][0]['resource_server_identifier'] );
    }

    /**
     * Test that an empty role ID throws an exception when trying to get users for a role.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetUsersRequestWithEmptyRoleIdThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->roles()->getUsers( '' );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid role_id', $exception_message );
    }

    /**
     * Test a paginated get role users call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetUsersRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->roles()->getUsers( '__test_role_id__', [ 'per_page' => 6, 'include_totals' => 1 ] );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith(
            'https://api.test.local/api/v2/roles/__test_role_id__/users',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'page=6', $query );
        $this->assertContains( 'include_totals=true', $query );
    }

    /**
     * Test that an empty role ID throws an exception when trying to add users to a role.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatAddUsersRequestWithEmptyRoleIdThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->roles()->addUsers( '', [] );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid role_id', $exception_message );
    }

    /**
     * Test that an empty users parameter throws an exception when trying to add users to a role.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatAddUsersRequestWithEmptyUsersThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->roles()->addUsers( '__test_role_id__', [] );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid users', $exception_message );
    }

    /**
     * Test an add role user call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatAddUsersRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->roles()->addUsers(
            '__test_role_id__',
            [ 'strategy|1234567890', 'strategy|0987654321' ]
        );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://api.test.local/api/v2/roles/__test_role_id__/users',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'users', $body );
        $this->assertCount( 2, $body['users'] );
        $this->assertContains( 'strategy|1234567890', $body['users'] );
        $this->assertContains( 'strategy|0987654321', $body['users'] );
    }
}
