<?php

declare(strict_types=1);

uses()->group('management', 'management.jobs');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->jobs();
});

test('get() issues an appropriate request', function(): void {
    $this->endpoint->get('__test_id__');

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/jobs/__test_id__', $this->api->getRequestUrl());
});

test('getErrors() issues an appropriate request', function(): void {
    $this->endpoint->getErrors('__test_id__');

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/jobs/__test_id__/errors', $this->api->getRequestUrl());
});

test('createImportUsers() issues an appropriate request', function(): void {
    $importPath = AUTH0_PHP_TEST_JSON_DIR . 'test-import-users-file.json';
    $keyOffset = 3;

    $this->endpoint->createImportUsers(
        $importPath,
        '__test_conn_id__',
        [
            'upsert' => true,
            'send_completion_email' => true,
            'external_id' => '__test_ext_id__',
        ]
    );

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/jobs/users-imports', $this->api->getRequestUrl());

    $headers = $this->api->getRequestHeaders();
    $this->assertStringStartsWith('multipart/form-data', $headers['Content-Type'][0]);

    $form_body = $this->api->getRequestBodyAsString();
    $form_body_arr = explode("\r\n", $form_body);

    // Test that the form data contains our import file content.
    $import_content = file_get_contents($importPath);
    $this->assertStringContainsString('name="users"; filename="test-import-users-file.json"', $form_body);
    $this->assertStringContainsString($import_content, $form_body);

    $conn_id_key = array_search('Content-Disposition: form-data; name="connection_id"', $form_body_arr);
    $this->assertNotEmpty($conn_id_key);
    $this->assertEquals('__test_conn_id__', $form_body_arr[$conn_id_key + $keyOffset]);

    $upsert_key = array_search('Content-Disposition: form-data; name="upsert"', $form_body_arr);
    $this->assertNotEmpty($upsert_key);
    $this->assertEquals('true', $form_body_arr[$upsert_key + $keyOffset]);

    $email_key = array_search('Content-Disposition: form-data; name="send_completion_email"', $form_body_arr);
    $this->assertNotEmpty($email_key);
    $this->assertEquals('true', $form_body_arr[$email_key + $keyOffset]);

    $ext_id_key = array_search('Content-Disposition: form-data; name="external_id"', $form_body_arr);
    $this->assertNotEmpty($ext_id_key);
    $this->assertEquals('__test_ext_id__', $form_body_arr[$ext_id_key + $keyOffset]);
});

test('createExportUsers() issues an appropriate request', function(): void {
    $mock = [
        'connection_id' => uniqid(),
        'limit' => uniqid(),
        'format' => 'json',
        'fields' => [
            [
                'name' => uniqid()
            ]
        ],
    ];

    $this->endpoint->createExportUsers($mock);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/jobs/users-exports', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());

    $request_body = $this->api->getRequestBody();

    $this->assertNotEmpty($request_body['connection_id']);
    $this->assertEquals($mock['connection_id'], $request_body['connection_id']);

    $this->assertNotEmpty($request_body['limit']);
    $this->assertEquals($mock['limit'], $request_body['limit']);

    $this->assertNotEmpty($request_body['format']);
    $this->assertEquals('json', $request_body['format']);

    $this->assertNotEmpty($request_body['fields']);
    $this->assertEquals([['name' => $mock['fields'][0]['name']]], $request_body['fields']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode((object) $mock), $body);
});

test('createSendVerificationEmail() issues an appropriate request', function(): void {
    $mock = (object) [
        'userId' => uniqid(),
        'body' =>             [
            'client_id' => '__test_client_id__',
            'identity' => [
                'user_id' => '__test_secondary_user_id__',
                'provider' => '__test_provider__',
            ],
        ]
    ];

    $this->endpoint->createSendVerificationEmail($mock->userId, $mock->body);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/jobs/verification-email', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('user_id', $body);
    $this->assertEquals($mock->userId, $body['user_id']);
    $this->assertArrayHasKey('client_id', $body);
    $this->assertEquals($mock->body['client_id'], $body['client_id']);
    $this->assertArrayHasKey('identity', $body);
    $this->assertEquals($mock->body['identity'], $body['identity']);

    $headers = $this->api->getRequestHeaders();
    $this->assertEquals('application/json', $headers['Content-Type'][0]);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(array_merge(['user_id' => $mock->userId], $mock->body)), $body);
});
