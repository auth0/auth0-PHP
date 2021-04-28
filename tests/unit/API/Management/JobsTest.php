<?php

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
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
    protected static $headers = ['content-type' => 'json'];

    /**
     * Runs before test suite starts.
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        self::$testImportUsersJsonPath = AUTH0_PHP_TEST_JSON_DIR . 'test-import-users-file.json';
        $infoHeadersData = new InformationHeaders();
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    /**
     * Test get().
     *
     * @return void
     */
    public function testGet()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->jobs()->get('__test_id__');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/jobs/__test_id__', $api->getHistoryUrl());
    }

    /**
     * Test getErrors().
     *
     * @return void
     */
    public function testGetErrors()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->jobs()->getErrors('__test_id__');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/jobs/__test_id__/errors', $api->getHistoryUrl());
    }

    /**
     * Test importUsers().
     *
     * @return void
     */
    public function testImportUsers()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->jobs()->createImportUsers(
            self::$testImportUsersJsonPath,
            '__test_conn_id__',
            [
                'upsert' => true,
                'send_completion_email' => true,
                'external_id' => '__test_ext_id__',
            ]
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/jobs/users-imports', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertStringStartsWith('multipart/form-data', $headers['Content-Type'][0]);

        $form_body     = $api->getHistoryBodyAsString();
        $form_body_arr = explode("\r\n", $form_body);

        // Test that the form data contains our import file content.
        $import_content = file_get_contents(self::$testImportUsersJsonPath);
        $this->assertStringContainsString('name="users"; filename="test-import-users-file.json"', $form_body);
        $this->assertStringContainsString($import_content, $form_body);

        $conn_id_key = array_search('Content-Disposition: form-data; name="connection_id"', $form_body_arr);
        $this->assertNotEmpty($conn_id_key);
        $this->assertEquals('__test_conn_id__', $form_body_arr[$conn_id_key + self::FORM_DATA_VALUE_KEY_OFFSET]);

        $upsert_key = array_search('Content-Disposition: form-data; name="upsert"', $form_body_arr);
        $this->assertNotEmpty($upsert_key);
        $this->assertEquals('true', $form_body_arr[$upsert_key + self::FORM_DATA_VALUE_KEY_OFFSET]);

        $email_key = array_search('Content-Disposition: form-data; name="send_completion_email"', $form_body_arr);
        $this->assertNotEmpty($email_key);
        $this->assertEquals('true', $form_body_arr[$email_key + self::FORM_DATA_VALUE_KEY_OFFSET]);

        $ext_id_key = array_search('Content-Disposition: form-data; name="external_id"', $form_body_arr);
        $this->assertNotEmpty($ext_id_key);
        $this->assertEquals('__test_ext_id__', $form_body_arr[$ext_id_key + self::FORM_DATA_VALUE_KEY_OFFSET]);
    }

    /**
     * Test exportUsers().
     *
     * @return void
     */
    public function testExportUsers()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->jobs()->createExportUsers(
            [
                'connection_id' => '__test_conn_id__',
                'limit' => 5,
                'format' => 'json',
                'fields' => [['name' => 'user_id']],
            ]
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/jobs/users-exports', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());

        $request_body = $api->getHistoryBody();

        $this->assertNotEmpty($request_body['connection_id']);
        $this->assertEquals('__test_conn_id__', $request_body['connection_id']);

        $this->assertNotEmpty($request_body['limit']);
        $this->assertEquals('5', $request_body['limit']);

        $this->assertNotEmpty($request_body['format']);
        $this->assertEquals('json', $request_body['format']);

        $this->assertNotEmpty($request_body['fields']);
        $this->assertEquals([['name' => 'user_id']], $request_body['fields']);
    }

    /**
     * Test sendVerificationEmail().
     *
     * @return void
     */
    public function testSendVerificationEmail()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->jobs()->createSendVerificationEmail(
            '__test_user_id__',
            [
                'client_id' => '__test_client_id__',
                'identity' => [
                    'user_id' => '__test_secondary_user_id__',
                    'provider' => '__test_provider__',
                ],
            ]
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/jobs/verification-email', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('user_id', $body);
        $this->assertEquals('__test_user_id__', $body['user_id']);
        $this->assertArrayHasKey('client_id', $body);
        $this->assertEquals('__test_client_id__', $body['client_id']);
        $this->assertArrayHasKey('identity', $body);
        $this->assertEquals(
            [
                'user_id' => '__test_secondary_user_id__',
                'provider' => '__test_provider__',
            ],
            $body['identity']
        );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }
}
