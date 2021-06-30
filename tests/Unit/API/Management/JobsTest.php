<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

class JobsTest extends TestCase
{
    protected const FORM_DATA_VALUE_KEY_OFFSET = 3;

    /**
     * Expected telemetry value.
     */
    protected static string $testImportUsersJsonPath;

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass(): void
    {
        self::$testImportUsersJsonPath = AUTH0_PHP_TEST_JSON_DIR . 'test-import-users-file.json';
    }

    /**
     * Test get().
     */
    public function testGet(): void
    {
        $api = new MockManagementApi();

        $api->mock()->jobs()->get('__test_id__');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/jobs/__test_id__', $api->getRequestUrl());
    }

    /**
     * Test getErrors().
     */
    public function testGetErrors(): void
    {
        $api = new MockManagementApi();

        $api->mock()->jobs()->getErrors('__test_id__');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/jobs/__test_id__/errors', $api->getRequestUrl());
    }

    /**
     * Test importUsers().
     */
    public function testImportUsers(): void
    {
        $api = new MockManagementApi();

        $api->mock()->jobs()->createImportUsers(
            self::$testImportUsersJsonPath,
            '__test_conn_id__',
            [
                'upsert' => true,
                'send_completion_email' => true,
                'external_id' => '__test_ext_id__',
            ]
        );

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/jobs/users-imports', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertStringStartsWith('multipart/form-data', $headers['Content-Type'][0]);

        $form_body = $api->getRequestBodyAsString();
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
     */
    public function testExportUsers(): void
    {
        $api = new MockManagementApi();

        $api->mock()->jobs()->createExportUsers(
            [
                'connection_id' => '__test_conn_id__',
                'limit' => 5,
                'format' => 'json',
                'fields' => [['name' => 'user_id']],
            ]
        );

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/jobs/users-exports', $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());

        $request_body = $api->getRequestBody();

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
     */
    public function testSendVerificationEmail(): void
    {
        $api = new MockManagementApi();

        $api->mock()->jobs()->createSendVerificationEmail(
            '__test_user_id__',
            [
                'client_id' => '__test_client_id__',
                'identity' => [
                    'user_id' => '__test_secondary_user_id__',
                    'provider' => '__test_provider__',
                ],
            ]
        );

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/jobs/verification-email', $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());

        $body = $api->getRequestBody();
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

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }
}
