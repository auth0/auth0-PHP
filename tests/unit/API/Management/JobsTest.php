<?php
namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

class JobsTest extends ApiTests
{

    const FORM_DATA_VALUE_KEY_OFFSET = 3;

    /**
     * Expected telemetry value.
     *
     * @var string
     */
    protected static $testImportUsersJsonPath;

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
        self::$testImportUsersJsonPath = AUTH0_PHP_TEST_JSON_DIR.'test-import-users-file.json';
        $infoHeadersData               = new InformationHeaders;
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    /**
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->jobs()->get( '__test_id__' );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/jobs/__test_id__', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetErrorsIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->jobs()->getErrors( '__test_id__' );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/jobs/__test_id__/errors', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatImportUsersRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->jobs()->importUsers(
            self::$testImportUsersJsonPath,
            '__test_conn_id__',
            [
                'upsert' => true,
                'send_completion_email' => true,
                'external_id' => '__test_ext_id__',
            ]
        );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/jobs/users-imports', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertStringStartsWith( 'multipart/form-data', $headers['Content-Type'][0] );

        $form_body     = $api->getHistoryBodyAsString();
        $form_body_arr = explode( "\r\n", $form_body );

        // Test that the form data contains our import file content.
        $import_content = file_get_contents( self::$testImportUsersJsonPath );
        $this->assertContains( 'name="users"; filename="test-import-users-file.json"', $form_body );
        $this->assertContains( $import_content, $form_body );

        $conn_id_key = array_search( 'Content-Disposition: form-data; name="connection_id"', $form_body_arr );
        $this->assertNotEmpty( $conn_id_key );
        $this->assertEquals( '__test_conn_id__', $form_body_arr[$conn_id_key + self::FORM_DATA_VALUE_KEY_OFFSET] );

        $upsert_key = array_search( 'Content-Disposition: form-data; name="upsert"', $form_body_arr );
        $this->assertNotEmpty( $upsert_key );
        $this->assertEquals( 'true', $form_body_arr[$upsert_key + self::FORM_DATA_VALUE_KEY_OFFSET] );

        $email_key = array_search( 'Content-Disposition: form-data; name="send_completion_email"', $form_body_arr );
        $this->assertNotEmpty( $email_key );
        $this->assertEquals( 'true', $form_body_arr[$email_key + self::FORM_DATA_VALUE_KEY_OFFSET] );

        $ext_id_key = array_search( 'Content-Disposition: form-data; name="external_id"', $form_body_arr );
        $this->assertNotEmpty( $ext_id_key );
        $this->assertEquals( '__test_ext_id__', $form_body_arr[$ext_id_key + self::FORM_DATA_VALUE_KEY_OFFSET] );
    }

    /**
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatExportUsersRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->jobs()->exportUsers(
            [
                'connection_id' => '__test_conn_id__',
                'limit' => 5,
                'format' => 'json',
                'fields' => [['name' => 'user_id']],
            ]
        );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/jobs/users-exports', $api->getHistoryUrl() );
        $this->assertEmpty( $api->getHistoryQuery() );

        $request_body = $api->getHistoryBody();

        $this->assertNotEmpty( $request_body['connection_id'] );
        $this->assertEquals( '__test_conn_id__', $request_body['connection_id'] );

        $this->assertNotEmpty( $request_body['limit'] );
        $this->assertEquals( '5', $request_body['limit'] );

        $this->assertNotEmpty( $request_body['format'] );
        $this->assertEquals( 'json', $request_body['format'] );

        $this->assertNotEmpty( $request_body['fields'] );
        $this->assertEquals( [['name' => 'user_id']], $request_body['fields'] );
    }

    /**
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatExportUsersRequestIsFilteringProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->jobs()->exportUsers(
            [
                'connection_id' => '__test_conn_id__',
                'limit' => 'invalid limit',
                'format' => 'invalid format',
            ]
        );

        $request_body = $api->getHistoryBody();

        $this->assertArrayNotHasKey('limit', $request_body);
        $this->assertArrayNotHasKey('format', $request_body);
    }

    /**
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatSendVerificationEmailIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->jobs()->sendVerificationEmail( '__test_user_id__', [
            'client_id' => '__test_client_id__',
            'identity' => [
                'user_id' => '__test_secondary_user_id__',
                'provider' => '__test_provider__'
            ]
        ] );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/jobs/verification-email', $api->getHistoryUrl() );
        $this->assertEmpty( $api->getHistoryQuery() );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'user_id', $body );
        $this->assertEquals( '__test_user_id__', $body['user_id'] );
        $this->assertArrayHasKey( 'client_id', $body );
        $this->assertEquals( '__test_client_id__', $body['client_id'] );
        $this->assertArrayHasKey( 'identity', $body);
        $this->assertEquals( [
            'user_id' => '__test_secondary_user_id__',
            'provider' => '__test_provider__'
        ], $body['identity']);

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
    }

    public function testIdentityParamRequiresUserId()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );
        $exception_message = '';

        try {
            $api->call()->jobs()->sendVerificationEmail( '__test_user_id__', [
              'identity' => [
                  'provider' => '__test_provider__'
              ]
            ] );
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertStringContainsString( 'Missing required "user_id" field of the "identity" object.', $exception_message );
    }

    public function testIdentityParamRequiresUserIdAsString()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );
        $exception_message = '';

        try {
            $api->call()->jobs()->sendVerificationEmail( '__test_user_id__', [
                'identity' => [
                    'user_id' => 42,
                    'provider' => '__test_provider__'
                ]
            ] );
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertStringContainsString( 'Missing required "user_id" field of the "identity" object.', $exception_message );
    }

    public function testIdentityParamRequiresProvider()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );
        $exception_message = '';

        try {
            $api->call()->jobs()->sendVerificationEmail( '__test_user_id__', [
                'identity' => [
                    'user_id' => '__test_secondary_user_id__'
                ]
            ] );
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertStringContainsString( 'Missing required "provider" field of the "identity" object.', $exception_message );
    }

    public function testIdentityParamRequiresProviderAsString()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );
        $exception_message = '';

        try {
            $api->call()->jobs()->sendVerificationEmail( '__test_user_id__', [
                'identity' => [
                    'user_id' => '__test_secondary_user_id__',
                    'provider' => 42
                ]
            ] );
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertStringContainsString( 'Missing required "provider" field of the "identity" object.', $exception_message );
    }
}
