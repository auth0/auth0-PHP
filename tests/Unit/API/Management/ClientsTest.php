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
