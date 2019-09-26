<?php
namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Management;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use Auth0\SDK\Exception\InvalidPermissionsArrayException;
use Auth0\Tests\Traits\ErrorHelpers;

use Auth0\SDK\API\Helpers\InformationHeaders;

use GuzzleHttp\Psr7\Response;

/**
 * Class UsersMockedTest.
 *
 * @package Auth0\Tests\API\Management
 */
class UsersMockedTest extends \PHPUnit_Framework_TestCase
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

    public function testThatMethodAndPropertyReturnSameClass()
    {
        $api = new Management(uniqid(), uniqid());
        $this->assertInstanceOf( Management\Users::class, $api->users );
        $this->assertInstanceOf( Management\Users::class, $api->users() );
        $api->users = null;
        $this->assertInstanceOf( Management\Users::class, $api->users() );
    }

    /**
     * Test a get user call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetUserRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->get( '__test_user_id__' );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/users/__test_user_id__', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test an update user call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatUpdateUserRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->update(
            '__test_user_id__',
            [
                'given_name' => '__test_given_name__',
                'user_metadata' => [
                    '__test_meta_key__' => '__test_meta_value__'
                ]
            ]
        );

        $this->assertEquals( 'PATCH', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/users/__test_user_id__', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'given_name', $body );
        $this->assertEquals( '__test_given_name__', $body['given_name'] );
        $this->assertArrayHasKey( 'user_metadata', $body );
        $this->assertArrayHasKey( '__test_meta_key__', $body['user_metadata'] );
        $this->assertEquals( '__test_meta_value__', $body['user_metadata']['__test_meta_key__'] );
    }

    public function testThatExceptionIsThrownWhenConnectionIsMissing()
    {
        $api = new Management( uniqid(), uniqid() );

        try {
            $api->users()->create( [] );
            $exception_message = '';
        } catch (\Exception $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Missing required "connection" field', $exception_message );
    }

    public function testThatExceptionIsThrownWhenSmsConnectionHasNoPhoneNumber()
    {
        $api = new Management( uniqid(), uniqid() );

        try {
            $api->users()->create( [ 'connection' => 'sms' ] );
            $exception_message = '';
        } catch (\Exception $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Missing required "phone_number" field for sms connection', $exception_message );
    }

    public function testThatExceptionIsThrownWhenConnectionHasNoEmailAddress()
    {
        $api = new Management( uniqid(), uniqid() );

        try {
            $api->users()->create( [ 'connection' => 'email' ] );
            $exception_message = '';
        } catch (\Exception $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Missing required "email" field', $exception_message );
    }

    public function testThatExceptionIsThrownWhenDbConnectionHasNoPassword()
    {
        $api = new Management( uniqid(), uniqid() );

        try {
            $api->users()->create( [ 'connection' => 'auth0', 'email' => uniqid() ] );
            $exception_message = '';
        } catch (\Exception $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Missing required "password" field for "auth0" connection', $exception_message );
    }

    /**
     * Test a create user call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatCreateUserRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->create( [
            'connection' => '__test_connection__',
            'email' => '__test_email__',
            'password' => '__test_password__',
        ] );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/users', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'connection', $body );
        $this->assertEquals( '__test_connection__', $body['connection'] );
        $this->assertArrayHasKey( 'email', $body );
        $this->assertEquals( '__test_email__', $body['email'] );
        $this->assertArrayHasKey( 'password', $body );
        $this->assertEquals( '__test_password__', $body['password'] );
    }

    /**
     * Test a basic getAll users call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllUsersRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->getAll();

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/users', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test a getAll users call with params.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllUsersAdditionalParamsAreSent()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->getAll( [ '__test_parameter__' => '__test_value__' ] );

        $query = $api->getHistoryQuery();
        $this->assertEquals( '__test_parameter__=__test_value__', $query );
    }

    /**
     * Test a getAll users call does not overwrite fields.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllUsersFieldsParamDoesNotOverwrite()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->getAll( [ 'fields' => 'field1,field2' ], 'field3' );

        $query = $api->getHistoryQuery();
        $this->assertEquals( 'fields=field1,field2', $query );
    }

    /**
     * Test that the fields values are sent correctly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllUsersFieldsAreFormattedCorrectly()
    {
        $api = new MockManagementApi( [
            new Response( 200, self::$headers ),
            new Response( 200, self::$headers ),
        ] );

        $api->call()->users()->getAll( [ 'fields' => 'field1,field2' ] );

        $query = $api->getHistoryQuery();
        $this->assertEquals( 'fields=field1,field2', $query );

        $api->call()->users()->getAll( [ 'fields' => [ 'field1', 'field2' ] ] );

        $query = $api->getHistoryQuery();
        $this->assertEquals( 'fields=field1,field2', $query );
    }

    /**
     * Test that the include_fields value is included.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllUsersIncludeFieldsIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->getAll( [], [ 'field3', 'field4' ], true );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'fields=field3,field4', $query );
        $this->assertContains( 'include_fields=true', $query );
    }

    /**
     * Test that the include_fields value passed in the extra params is not overwritten by the function param.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllUsersIncludeFieldsIsNotOverwritten()
    {
        $api = new MockManagementApi( [new Response( 200, self::$headers ) ] );

        $api->call()->users()->getAll( [ 'include_fields' => false ], [ 'field3' ], true );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'fields=field3', $query );
        $this->assertContains( 'include_fields=false', $query );
    }

    /**
     * Test that the include_fields value is converted to boolean.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllUsersIncludeFieldsIsConvertedToBool()
    {
        $api = new MockManagementApi( [new Response( 200, self::$headers ) ] );

        $api->call()->users()->getAll( [], [ 'field3' ], uniqid() );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'fields=field3', $query );
        $this->assertContains( 'include_fields=true', $query );
    }

    /**
     * Test that the page value is kept as an absolute integer.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllUsersWithPageIsFormattedProperly()
    {
        $api = new MockManagementApi( [
            new Response( 200, self::$headers ),
            new Response( 200, self::$headers ),
        ] );

        $api->call()->users()->getAll( [], [], null, 10 );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'page=10', $query );

        $api->call()->users()->getAll( [], [], null, -10 );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'page=10', $query );
    }

    /**
     * Test that the page value passed in extra params is not overwritten by the function param.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllUsersDoesNotOverwritePageValue()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->getAll( [ 'page' => 11 ], [], null, 22 );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'page=11', $query );
    }

    /**
     * Test that the per_page value is kept as an absolute integer.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllUsersWithPerPageIsFormattedProperly()
    {
        $api = new MockManagementApi( [
            new Response( 200, self::$headers ),
            new Response( 200, self::$headers ),
        ] );

        $api->call()->users()->getAll( [], [], null, null, 10 );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'per_page=10', $query );

        $api->call()->users()->getAll( [], [], null, null, -10 );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'per_page=10', $query );
    }

    /**
     * Test the the per_page value passed in the extra params is not overwritten by the function param.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllUsersDoesNotOverwritePerPageValue()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->getAll( [ 'per_page' => 8 ], [], null, null, 9 );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'per_page=8', $query );
    }

    /**
     * Test a delete user call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatDeleteUserRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->delete( '__test_user_id__' );

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/users/__test_user_id__', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test a link account call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatLinkAccountRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->linkAccount(
            '__test_user_id__',
            [
                'provider' => '__test_provider__',
                'connection_id' => '__test_connection_id__',
                'user_id' => '__test_secondary_user_id__',
            ]
        );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/users/__test_user_id__/identities', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'provider', $body );
        $this->assertEquals( '__test_provider__', $body['provider'] );
        $this->assertArrayHasKey( 'connection_id', $body );
        $this->assertEquals( '__test_connection_id__', $body['connection_id'] );
        $this->assertArrayHasKey( 'user_id', $body );
        $this->assertEquals( '__test_secondary_user_id__', $body['user_id'] );
    }

    /**
     * Test an unlink account call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatUnlinkAccountRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->unlinkAccount(
            '__test_user_id__',
            '__test_provider__',
            '__test_identity_id__'
        );

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://api.test.local/api/v2/users/__test_user_id__/identities/__test_provider__/__test_identity_id__',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test a delete multifactor provider call.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatDeleteMfProviderIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->deleteMultifactorProvider( '__test_user_id__', 'duo' );

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://api.test.local/api/v2/users/__test_user_id__/multifactor/duo',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test that a get roles call throws an exception if the user ID is missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetRolesThrowsExceptionIfUserIdIsMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->getRoles( '' );
            $caught_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $caught_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid user_id', $caught_message );
    }

    /**
     * Test that a get roles call is formatted properly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetRolesRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->getRoles( '__test_user_id__', [ 'per_page' => 5, 'page' => 1, 'include_totals' => 1 ] );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith(
            'https://api.test.local/api/v2/users/__test_user_id__/roles?',
            $api->getHistoryUrl()
        );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'per_page=5', $query );
        $this->assertContains( 'page=1', $query );
        $this->assertContains( 'include_totals=true', $query );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test that a remove roles call throws an exception if the user ID is missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatRemoveRolesThrowsExceptionIfUserIdIsMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->removeRoles( '', [] );
            $caught_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $caught_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid user_id', $caught_message );
    }

    /**
     * Test that a remove roles call throws an exception if roles are missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatRemoveRolesThrowsExceptionIfRolesAreMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->removeRoles( '__test_user_id__', [] );
            $caught_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $caught_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid roles', $caught_message );
    }

    /**
     * Test that a remove roles call is formatted properly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatRemoveRolesRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->removeRoles( '__test_user_id__', [ '__test_role_id__' ] );

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://api.test.local/api/v2/users/__test_user_id__/roles',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'roles', $body );
        $this->assertCount( 1, $body['roles'] );
        $this->assertEquals( '__test_role_id__', $body['roles'][0] );
    }

    /**
     * Test that an add roles call throws an exception if the user ID is missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatAddRolesThrowsExceptionIfUserIdIsMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->addRoles( '', [] );
            $caught_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $caught_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid user_id', $caught_message );
    }

    /**
     * Test that an add roles call throws an exception if roles are missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatAddRolesThrowsExceptionIfRolesAreMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->addRoles( '__test_user_id__', [] );
            $caught_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $caught_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid roles', $caught_message );
    }

    /**
     * Test that an add roles call is formatted properly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatAddRolesRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->addRoles( '__test_user_id__', [ '__test_role_id__' ] );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://api.test.local/api/v2/users/__test_user_id__/roles',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'roles', $body );
        $this->assertCount( 1, $body['roles'] );
        $this->assertEquals( '__test_role_id__', $body['roles'][0] );
    }

    /**
     * Test that a get enrollments call throws an exception if the user ID is missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetEnrollmentsThrowsExceptionIfUserIdIsMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->getEnrollments( '' );
            $caught_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $caught_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid user_id', $caught_message );
    }

    /**
     * Test that a get enrollments call is formatted properly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetEnrollmentsRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->getEnrollments( '__test_user_id__' );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://api.test.local/api/v2/users/__test_user_id__/enrollments',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test that a remove permissions call throws an exception if the user ID is missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetPermissionsThrowsExceptionIfUserIdIsMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->getPermissions( '' );
            $caught_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $caught_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid user_id', $caught_message );
    }

    /**
     * Test that a get permissions call is formatted properly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetPermissionsRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->getPermissions(
            '__test_user_id__',
            [ 'per_page' => 3, 'page' => 2, 'include_totals' => 0 ]
        );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith(
            'https://api.test.local/api/v2/users/__test_user_id__/permissions?',
            $api->getHistoryUrl()
        );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'per_page=3', $query );
        $this->assertContains( 'page=2', $query );
        $this->assertContains( 'include_totals=false', $query );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test that a remove permissions call throws an exception if the user ID is missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatRemovePermissionsThrowsExceptionIfUserIdIsMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->removePermissions( '', [] );
            $caught_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $caught_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid user_id', $caught_message );
    }

    /**
     * Test that a remove permissions call throws an exception if permissions are missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatRemovePermissionsThrowsExceptionIfPermissionsAreMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->removePermissions( '__test_user_id__', [] );
            $caught_exception = false;
        } catch (InvalidPermissionsArrayException $e) {
            $caught_exception = true;
        }

        $this->assertTrue( $caught_exception );
    }

    /**
     * Test that a remove permissions call is formatted properly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatRemovePermissionsRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->removePermissions(
            '__test_user_id__',
            [
                [
                    'permission_name' => 'test:permission',
                    'resource_server_identifier' => '__test_api_id__',
                ]
            ]
        );

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://api.test.local/api/v2/users/__test_user_id__/permissions',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'permissions', $body );
        $this->assertCount( 1, $body['permissions'] );
        $this->assertArrayHasKey( 'permission_name', $body['permissions'][0] );
        $this->assertEquals( 'test:permission', $body['permissions'][0]['permission_name'] );
        $this->assertArrayHasKey( 'resource_server_identifier', $body['permissions'][0] );
        $this->assertEquals( '__test_api_id__', $body['permissions'][0]['resource_server_identifier'] );
    }

    /**
     * Test that an add permissions call throws an exception if the user ID is missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatAddPermissionsThrowsExceptionIfUserIdIsMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->addPermissions( '', [] );
            $caught_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $caught_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid user_id', $caught_message );
    }

    /**
     * Test that an add permissions call throws an exception if permissions are missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatAddPermissionsThrowsExceptionIfPermissionsAreMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->addPermissions( '__test_user_id__', [] );
            $caught_exception = false;
        } catch (InvalidPermissionsArrayException $e) {
            $caught_exception = true;
        }

        $this->assertTrue( $caught_exception );
    }

    /**
     * Test that an add permissions call is formatted properly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatAddPermissionsRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->addPermissions(
            '__test_user_id__',
            [
                [
                    'permission_name' => 'test:permission',
                    'resource_server_identifier' => '__test_api_id__',
                ]
            ]
        );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://api.test.local/api/v2/users/__test_user_id__/permissions',
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
        $this->assertEquals( 'test:permission', $body['permissions'][0]['permission_name'] );
        $this->assertArrayHasKey( 'resource_server_identifier', $body['permissions'][0] );
        $this->assertEquals( '__test_api_id__', $body['permissions'][0]['resource_server_identifier'] );
    }

    /**
     * Test that a get logs call throws an exception if the user ID is missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetLogsThrowsExceptionIfUserIdIsMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->getLogs( '' );
            $caught_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $caught_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid user_id', $caught_message );
    }

    /**
     * Test that a get logs call is formatted properly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetLogsRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->getLogs(
            '__test_user_id__',
            [ 'per_page' => 3, 'page' => 2, 'include_totals' => 0, 'fields' => 'date,type,ip' ]
        );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith(
            'https://api.test.local/api/v2/users/__test_user_id__/logs?',
            $api->getHistoryUrl()
        );

        $query = $api->getHistoryQuery();
        $this->assertContains( 'per_page=3', $query );
        $this->assertContains( 'page=2', $query );
        $this->assertContains( 'include_totals=false', $query );
        $this->assertContains( 'fields=date,type,ip', $query );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test that a generate recovery code call throws an exception if the user ID is missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGenerateRecoveryCodeThrowsExceptionIfUserIdIsMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->generateRecoveryCode( '' );
            $caught_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $caught_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid user_id', $caught_message );
    }

    /**
     * Test that an generate recovery code call is formatted properly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGenerateRecoveryCodeRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->generateRecoveryCode( '__test_user_id__' );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://api.test.local/api/v2/users/__test_user_id__/recovery-code-regeneration',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
    }

    /**
     * Test that an invalidate browsers call throws an exception if the user ID is missing.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatInvalidateBrowsersThrowsExceptionIfUserIdIsMissing()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->users()->invalidateBrowsers( '' );
            $caught_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $caught_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid user_id', $caught_message );
    }

    /**
     * Test that an invalidate browsers call is formatted properly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatInvalidateBrowsersRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->users()->invalidateBrowsers( '__test_user_id__' );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://api.test.local/api/v2/users/__test_user_id__/multifactor/actions/invalidate-remember-browser',
            $api->getHistoryUrl()
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
    }
}
