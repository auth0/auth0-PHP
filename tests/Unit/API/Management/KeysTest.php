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
