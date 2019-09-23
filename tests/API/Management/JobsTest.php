<?php
namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\API\Management;
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

    public function testThatMethodAndPropertyReturnSameClass()
    {
        $api = new Management(uniqid(), uniqid());
        $this->assertInstanceOf( Management\Jobs::class, $api->jobs );
        $this->assertInstanceOf( Management\Jobs::class, $api->jobs() );
        $api->jobs = null;
        $this->assertInstanceOf( Management\Jobs::class, $api->jobs() );
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
    public function testThatSendVerificationEmailIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->jobs()->sendVerificationEmail( '__test_user_id__' );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/jobs/verification-email', $api->getHistoryUrl() );
        $this->assertEmpty( $api->getHistoryQuery() );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'user_id', $body );
        $this->assertEquals( '__test_user_id__', $body['user_id'] );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
    }

    /**
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Exception
     */
    public function testIntegrationImportUsersJob()
    {
        $env = self::getEnv();

        if (! $env['API_TOKEN']) {
            $this->markTestSkipped( 'No client secret; integration test skipped' );
        }

        $api = new Management($env['API_TOKEN'], $env['DOMAIN']);

        // Get a single, active database connection.
        $default_db_name       = 'Username-Password-Authentication';
        $get_connection_result = $api->connections->getAll( 'auth0', ['id'], true, 0, 1, ['name' => $default_db_name] );
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        $conn_id            = $get_connection_result[0]['id'];
        $import_user_params = [
            'upsert' => true,
            'send_completion_email' => false,
            'external_id' => '__test_ext_id__',
        ];

        $import_job_result = $api->jobs()->importUsers(self::$testImportUsersJsonPath, $conn_id, $import_user_params);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        $this->assertEquals( $conn_id, $import_job_result['connection_id'] );
        $this->assertEquals( $default_db_name, $import_job_result['connection'] );
        $this->assertEquals( '__test_ext_id__', $import_job_result['external_id'] );
        $this->assertEquals( 'users_import', $import_job_result['type'] );

        $get_job_result = $api->jobs()->get($import_job_result['id']);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        $this->assertEquals( $conn_id, $get_job_result['connection_id'] );
        $this->assertEquals( $default_db_name, $get_job_result['connection'] );
        $this->assertEquals( '__test_ext_id__', $get_job_result['external_id'] );
        $this->assertEquals( 'users_import', $get_job_result['type'] );
    }

    /**
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Exception
     */
    public function testIntegrationSendEmailVerificationJob()
    {
        $env = self::getEnv();

        if (! $env['API_TOKEN']) {
            $this->markTestSkipped( 'No client secret; integration test skipped' );
        }

        $api = new Management($env['API_TOKEN'], $env['DOMAIN']);

        $create_user_data   = [
            'connection' => 'Username-Password-Authentication',
            'email' => 'php-sdk-test-email-verification-job-'.uniqid().'@auth0.com',
            'password' => uniqid().uniqid().uniqid(),
        ];
        $create_user_result = $api->users->create( $create_user_data );
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        $user_id = $create_user_result['user_id'];

        $email_job_result = $api->jobs()->sendVerificationEmail($user_id);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        $this->assertEquals( 'verification_email', $email_job_result['type'] );

        $get_job_result = $api->jobs()->get($email_job_result['id']);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        $this->assertEquals( 'verification_email', $get_job_result['type'] );

        $api->users->delete( $user_id );
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    }
}
