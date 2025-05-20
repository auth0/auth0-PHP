<?php

declare(strict_types=1);

use Auth0\Tests\Utilities\TokenGenerator;

uses()->group('management', 'management.clients');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->clients();
});

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll(['client_id' => '__test_client_id__', 'app_type' => '__test_app_type__']);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://' . $this->api->mock()->getConfiguration()->getDomain() . '/api/v2/clients');

    $query = $this->api->getRequestQuery();
    expect($query)->toContain('&client_id=__test_client_id__&app_type=__test_app_type__');
});

test('get() issues an appropriate request', function(): void {
    $this->endpoint->get('__test_id__');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://' . $this->api->mock()->getConfiguration()->getDomain() . '/api/v2/clients/__test_id__');
});

test('delete() issues an appropriate request', function(): void {
    $this->endpoint->delete('__test_id__');

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/clients/__test_id__');
});

test('create() issues an appropriate request', function(): void {
    $mock = (object) [
        'name' => uniqid(),
        'body'=> [
            'app_type' => uniqid()
        ]
    ];

    $this->endpoint->create($mock->name, $mock->body);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/clients');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual($mock->name);
    $this->assertArrayHasKey('app_type', $body);
    expect($body['app_type'])->toEqual($mock->body['app_type']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(array_merge(['name' => $mock->name], $mock->body)));
});

test('update() issues an appropriate request', function(): void {
    $this->endpoint->update('__test_id__', ['name' => '__test_new_name__']);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/clients/__test_id__');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual('__test_new_name__');
});

test('update() does NOT nullify empty `initiate_login_uri` values', function(): void {
    $this->endpoint->update('__test_id__', ['name' => '__test_new_name__', 'initiate_login_uri' => '']);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/clients/__test_id__');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual('__test_new_name__');
    expect($body['initiate_login_uri'])->toEqual('');
});

test('getCredentials() issues an appropriate request', function(): void {
    $mockClientId = uniqid();
    $this->endpoint->getCredentials($mockClientId, ['client_id' => '__test_client_id__', 'app_type' => '__test_app_type__']);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://' . $this->api->mock()->getConfiguration()->getDomain() . '/api/v2/clients/' . $mockClientId . '/credentials');

    $query = $this->api->getRequestQuery();
    expect($query)->toContain('&client_id=__test_client_id__&app_type=__test_app_type__');
});

test('getCredential() issues an appropriate request', function(): void {
    $mockClientId = uniqid();
    $mockCredentialId = uniqid();
    $this->endpoint->getCredential($mockClientId, $mockCredentialId);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://' . $this->api->mock()->getConfiguration()->getDomain() . '/api/v2/clients/' . $mockClientId . '/credentials/' . $mockCredentialId);
});

test('deleteCredential() issues an appropriate request', function(): void {
    $mockClientId = uniqid();
    $mockCredentialId = uniqid();
    $this->endpoint->deleteCredential($mockClientId, $mockCredentialId);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/clients/' . $mockClientId . '/credentials/' . $mockCredentialId);
});

test('createCredentials() issues an appropriate request', function(): void {
    $mockCertificate = TokenGenerator::generateRsaKeyPair();
    $mockClientId = uniqid();
    $mockRequestBody = [
        [
            'credential_type' => 'public_key',
            'name' => 'my pub key',
            'pem' => $mockCertificate['cert'],
        ]
    ];

    $this->endpoint->createCredentials($mockClientId, $mockRequestBody);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/clients/' . $mockClientId . '/credentials');

    $body = $this->api->getRequestBody();

    expect($body)
        ->toBeArray()
        ->toHaveCount(1);

    expect($body[0])
        ->toBeArray()
        ->toHaveKeys(['credential_type', 'name', 'pem'])
        ->credential_type->toEqual('public_key')
        ->name->toEqual('my pub key')
        ->pem->toEqual($mockCertificate['cert']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode((object) $mockRequestBody));
});

test('getAll() issues an appropriate request with organization queries', function(): void {
    $this->endpoint->getAll(['q' => 'allow_any_organization=true']);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://' . $this->api->mock()->getConfiguration()->getDomain() . '/api/v2/clients');

    expect($this->api->getRequestQuery(null))->toEqual('q=' . rawurlencode('allow_any_organization=true'));
});

test('create() issues an appropriate request with default_organization', function(): void {
    $mock = (object) [
        'name' => uniqid(),
        'body' => [
            'default_organization' => [
                'flows' => ["client_credentials"],
                'organization_id' => "org_" . uniqid()
            ]
        ]
    ];
   
    $this->endpoint->create($mock->name, $mock->body);
  
    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/clients');

    $body = $this->api->getRequestBody();

    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual($mock->name);

    // Check for default_organization
    $this->assertArrayHasKey('default_organization', $body);
    expect($body['default_organization']['organization_id'])->toEqual($mock->body['default_organization']['organization_id']);
    expect($body['default_organization']['flows'])->toEqual($mock->body['default_organization']['flows']);

    // Ensure the request body matches the expected format
    expect($this->api->getRequestBodyAsString())->toEqual(json_encode(array_merge(['name' => $mock->name], $mock->body)));
});

test('update() issues an appropriate request with organization queries', function(): void {
    $clientId = uniqid();
    $mock = (object) [
        'body' => [
            'default_organization' => [
                'flows' => ["client_credentials"],
                'organization_id' => "org_" . uniqid()
            ]
        ]
    ];
   
    $this->endpoint->update($clientId, $mock->body);
  
    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/clients/' . $clientId);

    $body = $this->api->getRequestBody();

    // Check for default_organization
    $this->assertArrayHasKey('default_organization', $body);
    expect($body['default_organization']['organization_id'])->toEqual($mock->body['default_organization']['organization_id']);
    expect($body['default_organization']['flows'])->toEqual($mock->body['default_organization']['flows']);

    // Ensure the request body matches the expected format
    expect($this->api->getRequestBodyAsString())->toEqual(json_encode($mock->body));
});

test('create() issues an appropriate request with full token_quota client_credentials', function(): void {
    $mock = (object)[
        'name' => uniqid(),
        'body' => [
            'token_quota' => [
                'client_credentials' => [
                    'per_day'  => 100,
                    'per_hour' => 20,
                    'enforce'  => true,
                ],
            ],
        ],
    ];

    $this->endpoint->create($mock->name, $mock->body);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/clients');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual($mock->name);

    $this->assertArrayHasKey('token_quota', $body);
    $qc = $body['token_quota']['client_credentials'];
    expect($qc['per_day'])->toEqual(100);
    expect($qc['per_hour'])->toEqual(20);
    expect($qc['enforce'])->toEqual(true);

    expect($this->api->getRequestBodyAsString())
        ->toEqual(json_encode(array_merge(['name' => $mock->name], $mock->body)));
});

test('create() issues an appropriate request with token_quota enforce=false only', function(): void {
    $mock = (object)[
        'name' => uniqid(),
        'body' => [
            'token_quota' => [
                'client_credentials' => [
                    'enforce' => false,
                ],
            ],
        ],
    ];

    $this->endpoint->create($mock->name, $mock->body);

    $qc = $this->api->getRequestBody()['token_quota']['client_credentials'];
    expect($qc['enforce'])->toEqual(false);
    $this->assertArrayNotHasKey('per_day', $qc);
    $this->assertArrayNotHasKey('per_hour', $qc);
});

test('create() issues an appropriate request with token_quota per_hour only', function(): void {
    $mock = (object)[
        'name' => uniqid(),
        'body' => [
            'token_quota' => [
                'client_credentials' => [
                    'per_hour' => 50,
                ],
            ],
        ],
    ];

    $this->endpoint->create($mock->name, $mock->body);

    $qc = $this->api->getRequestBody()['token_quota']['client_credentials'];
    expect($qc['per_hour'])->toEqual(50);
    $this->assertArrayNotHasKey('per_day', $qc);
    $this->assertArrayNotHasKey('enforce', $qc);
});

test('create() issues an appropriate request with token_quota per_day only', function(): void {
    $mock = (object)[
        'name' => uniqid(),
        'body' => [
            'token_quota' => [
                'client_credentials' => [
                    'per_day' => 200,
                ],
            ],
        ],
    ];

    $this->endpoint->create($mock->name, $mock->body);

    $qc = $this->api->getRequestBody()['token_quota']['client_credentials'];
    expect($qc['per_day'])->toEqual(200);
    $this->assertArrayNotHasKey('per_hour', $qc);
    $this->assertArrayNotHasKey('enforce', $qc);
});

test('update() issues an appropriate PATCH with full token_quota client_credentials', function(): void {
    $clientId = uniqid('client_');
    $mock     = (object)[
        'body' => [
            'token_quota' => [
                'client_credentials' => [
                    'per_day'  => 100,
                    'per_hour' => 20,
                    'enforce'  => true,
                ],
            ],
        ],
    ];

    $this->endpoint->update($clientId, $mock->body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEndWith("/api/v2/clients/{$clientId}");

    $body = $this->api->getRequestBody();

    $this->assertArrayHasKey('token_quota', $body);
    $qc = $body['token_quota']['client_credentials'];
    expect($qc['per_day'])->toEqual(100);
    expect($qc['per_hour'])->toEqual(20);
    expect($qc['enforce'])->toEqual(true);

 
    expect($this->api->getRequestBodyAsString())->toEqual(json_encode($mock->body));
});

test('update() issues an appropriate PATCH with token_quota enforce=false only', function(): void {
    $clientId = uniqid('client_');
    $mock     = (object)[
        'body' => [
            'token_quota' => [
                'client_credentials' => [
                    'enforce' => false,
                ],
            ],
        ],
    ];

    $this->endpoint->update($clientId, $mock->body);

    $qc = $this->api->getRequestBody()['token_quota']['client_credentials'];
    expect($qc['enforce'])->toEqual(false);
    $this->assertArrayNotHasKey('per_day', $qc);
    $this->assertArrayNotHasKey('per_hour', $qc);
});

test('update() issues an appropriate PATCH with token_quota per_hour only', function(): void {
    $clientId = uniqid('client_');
    $mock     = (object)[
        'body' => [
            'token_quota' => [
                'client_credentials' => [
                    'per_hour' => 50,
                ],
            ],
        ],
    ];

    $this->endpoint->update($clientId, $mock->body);

    $qc = $this->api->getRequestBody()['token_quota']['client_credentials'];
    expect($qc['per_hour'])->toEqual(50);
    $this->assertArrayNotHasKey('per_day', $qc);
    $this->assertArrayNotHasKey('enforce', $qc);
});

test('update() issues an appropriate PATCH with token_quota per_day only', function(): void {
    $clientId = uniqid('client_');
    $mock     = (object)[
        'body' => [
            'token_quota' => [
                'client_credentials' => [
                    'per_day' => 200,
                ],
            ],
        ],
    ];

    $this->endpoint->update($clientId, $mock->body);

    $qc = $this->api->getRequestBody()['token_quota']['client_credentials'];
    expect($qc['per_day'])->toEqual(200);
    $this->assertArrayNotHasKey('per_hour', $qc);
    $this->assertArrayNotHasKey('enforce', $qc);
});



