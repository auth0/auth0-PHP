<?php

declare(strict_types=1);

use Auth0\SDK\Exception\ArgumentException;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\SDK\Utility\HttpResponse;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Auth0\Tests\Utilities\MockDomain;

uses()->group('management', 'management.keys');

beforeEach(function(): void {
    $this->config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    $this->client = new HttpClient($this->config, HttpClient::CONTEXT_MANAGEMENT_CLIENT);
    $this->endpoint = $this->api->mock()->keys();
});

test('getEncryptionKey() issues an appropriate request', function(): void {
    $keyId = uniqid();

    $this->endpoint->getEncryptionKey($keyId);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://' . $this->api->mock()->getConfiguration()->getDomain() . '/api/v2/keys/encryption/' . $keyId);
});

test('getEncryptionKeys() issues an appropriate request', function(): void {
    $this->endpoint->getEncryptionKeys();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/keys/encryption');
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('postEncryption() issues an appropriate request', function(): void {
    $type = 'environment-root-key';
    $mock = (object) [
        'body' => [
            'type' => $type
        ]
    ];

    $this->endpoint->postEncryption($mock->body);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/keys/encryption');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('type', $body);;
    expect($body['type'])->toEqual($type);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['type' => $type]));
});

test('postEncryptionKey() issues an appropriate request', function(): void {
    $keyId = uniqid();
    $wrappedKey = 'base64 encoded ciphertext of wrapped key';
    $mock = (object) [
        'body' => [
            'wrappedKey' => $wrappedKey
        ]
    ];

    $this->endpoint->postEncryptionKey($keyId, $mock->body);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/keys/encryption/' . $keyId);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('wrappedKey', $body);;
    expect($body['wrappedKey'])->toEqual($wrappedKey);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['wrappedKey' => $wrappedKey]));
});

test('postEncryptionRekey() issues an appropriate request', function(): void {

    $this->endpoint->postEncryptionRekey();

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/keys/encryption/rekey');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');
});

test('postEncryptionRekey() returns 204 on success', function(): void {

    // Mocked the API response for successful rekey with status 204
    $this->httpResponse204 = HttpResponseGenerator::create('success', 204);

    // Mocked the client to return the mocked 204 response
    $this->client->mockResponse($this->httpResponse204);
    $response = $this->client->method('post')
        ->addPath(['keys', 'encryption', 'rekey'])
        ->call();
    expect($response->getStatusCode())->toEqual(204);
});

test('postEncryptionWrappingKey() issues an appropriate request', function(): void {
    $keyId = uniqid();

    $this->endpoint->postEncryptionWrappingKey($keyId);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/keys/encryption/' . $keyId . '/wrapping-key');
});

test('deleteEncryptionKey() issues an appropriate request', function(): void {
    $keyId = uniqid();

    $this->endpoint->deleteEncryptionKey($keyId);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/keys/encryption/' . $keyId);
});

