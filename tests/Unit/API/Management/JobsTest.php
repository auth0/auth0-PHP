<?php

declare(strict_types=1);

uses()->group('management', 'management.jobs');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->jobs();
});

test('get() issues an appropriate request', function(): void {
    $this->endpoint->get('__test_id__');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/jobs/__test_id__');
});

test('getErrors() issues an appropriate request', function(): void {
    $this->endpoint->getErrors('__test_id__');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/jobs/__test_id__/errors');
});

test('createImportUsers() issues an appropriate request', function(): void {
    $importPath = join(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, 'json', 'test-import-users-file.json']);
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

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/jobs/users-imports');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toStartWith('multipart/form-data');

    $form_body = $this->api->getRequestBodyAsString();
    $form_body_arr = explode("\r\n", $form_body);

    // Test that the form data contains our import file content.
    $import_content = file_get_contents($importPath);
    expect($form_body)->toContain('name="users"; filename="test-import-users-file.json"');
    expect($form_body)->toContain($import_content);

    $conn_id_key = array_search('Content-Disposition: form-data; name="connection_id"', $form_body_arr);
    $this->assertNotEmpty($conn_id_key);
    expect($form_body_arr[$conn_id_key + $keyOffset])->toEqual('__test_conn_id__');

    $upsert_key = array_search('Content-Disposition: form-data; name="upsert"', $form_body_arr);
    $this->assertNotEmpty($upsert_key);
    expect($form_body_arr[$upsert_key + $keyOffset])->toEqual('true');

    $email_key = array_search('Content-Disposition: form-data; name="send_completion_email"', $form_body_arr);
    $this->assertNotEmpty($email_key);
    expect($form_body_arr[$email_key + $keyOffset])->toEqual('true');

    $ext_id_key = array_search('Content-Disposition: form-data; name="external_id"', $form_body_arr);
    $this->assertNotEmpty($ext_id_key);
    expect($form_body_arr[$ext_id_key + $keyOffset])->toEqual('__test_ext_id__');
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

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/jobs/users-exports');
    expect($this->api->getRequestQuery())->toBeEmpty();

    $request_body = $this->api->getRequestBody();

    $this->assertNotEmpty($request_body['connection_id']);
    expect($request_body['connection_id'])->toEqual($mock['connection_id']);

    $this->assertNotEmpty($request_body['limit']);
    expect($request_body['limit'])->toEqual($mock['limit']);

    $this->assertNotEmpty($request_body['format']);
    expect($request_body['format'])->toEqual('json');

    $this->assertNotEmpty($request_body['fields']);
    expect($request_body['fields'])->toEqual([['name' => $mock['fields'][0]['name']]]);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode((object) $mock));
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

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/jobs/verification-email');
    expect($this->api->getRequestQuery())->toBeEmpty();

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('user_id', $body);
    expect($body['user_id'])->toEqual($mock->userId);
    $this->assertArrayHasKey('client_id', $body);
    expect($body['client_id'])->toEqual($mock->body['client_id']);
    $this->assertArrayHasKey('identity', $body);
    expect($body['identity'])->toEqual($mock->body['identity']);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(array_merge(['user_id' => $mock->userId], $mock->body)));
});
