<?php

declare(strict_types=1);

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management\Jobs;
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Exception\Authentication\ParResponseException;
use Auth0\SDK\Exception\NetworkException;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Auth0\Tests\Utilities\MockDomain;
use Auth0\Tests\Utilities\TokenGenerator;

uses()->group('authentication', 'authentication.pushedAuthorizationRequest');

beforeEach(function(): void {
    $this->secret = uniqid();

    $this->configuration = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE,
        'domain' => MockDomain::valid(),
        'clientId' => 'test_client_id',
        'clientSecret' => $this->secret,
    ]);
});

test('create() issues a successful network request', function(): void {
    $sdk = new Auth0($this->configuration);
    $authentication = $sdk->authentication();
    $httpClient = $authentication->getHttpClient();

    $mockRequestUri = 'https://example.com/par';

    $httpClient->mockResponse(
        HttpResponseGenerator::create(
            body: sprintf('{"request_uri": "%s", "expires_in": 90}', $mockRequestUri),
            statusCode: 201,
            headers: ['Content-Type' => 'application/json']
        ),
    );

    $clientId = uniqid();
    $connectionId = uniqid();
    $header = uniqid();

    $parameters = [
        'client_id' => $clientId,
        'connection' => $connectionId,
    ];

    $headers = [
        'x-testing' => $header,
    ];

    $authorizationUri = $authentication->pushedAuthorizationRequest()->create($parameters, $headers);

    expect($authorizationUri)
        ->toEqual(sprintf('%s/authorize?client_id=%s&request_uri=%s', $this->configuration->formatDomain(), $clientId, urlencode($mockRequestUri)));
});

test('create() throws an exception if the API returns something other than a 201 status code', function(): void {
    $sdk = new Auth0($this->configuration);

    $sdk->authentication()->getHttpClient()->mockResponse(
        HttpResponseGenerator::create(
            statusCode: 500,
        ),
    );

    $sdk->authentication()->pushedAuthorizationRequest()->create();
})->throws(NetworkException::class, sprintf(NetworkException::MSG_NETWORK_REQUEST_FAILED, 500));

test('create() throws an exception if the returned API response is malformed', function(): void {
    $sdk = new Auth0($this->configuration);

    $sdk->authentication()->getHttpClient()->mockResponse(
        HttpResponseGenerator::create(
            body: '{"nonsense": "response"}',
            statusCode: 201,
            headers: ['Content-Type' => 'application/json']
        ),
    );

    $sdk->authentication()->pushedAuthorizationRequest()->create();
})->throws(ParResponseException::class, ParResponseException::message());

test('post() issues a successful network request', function(): void {
    $sdk = new Auth0($this->configuration);
    $authentication = $sdk->authentication();
    $httpClient = $authentication->getHttpClient();

    $mockRequestUri = 'https://example.com/par';

    $httpClient->mockResponse(
        HttpResponseGenerator::create(
            body: sprintf('{"request_uri": "%s", "expires_in": 90}', $mockRequestUri),
            statusCode: 201,
            headers: ['Content-Type' => 'application/json']
        ),
    );

    $clientId = uniqid();
    $connectionId = uniqid();
    $header = uniqid();

    $parameters = [
        'client_id' => $clientId,
        'connection' => $connectionId,
    ];

    $headers = [
        'x-testing' => $header,
    ];

    $authentication->pushedAuthorizationRequest()->create($parameters, $headers);
    $request = $httpClient->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();

    parse_str((string) $request->getBody(), $requestBody);

    expect($request->getMethod() === 'POST')
        ->toEqual($this->configuration->getDomain());

    expect($request->getHeader('x-testing'))
        ->toEqual([$header]);

    expect($requestUri)
        ->getHost()
            ->toEqual($this->configuration->getDomain())
        ->getPath()
            ->toEqual('/oauth/par');

    expect($requestBody)
        ->toBeArray()
        ->toHaveKey('response_mode', 'query')
        ->toHaveKey('response_type', 'code')
        ->toHaveKey('scope', 'openid profile email')
        ->toHaveKey('client_id', $clientId)
        ->toHaveKey('client_secret', $this->secret)
        ->toHaveKey('connection', $connectionId);
});

test('post() supports client assertion', function(): void {
    $secret = TokenGenerator::generateRsaKeyPair();
    $this->configuration->setClientAssertionSigningKey($secret['private']);

    $sdk = new Auth0($this->configuration);
    $authentication = $sdk->authentication();
    $httpClient = $authentication->getHttpClient();

    $mockRequestUri = 'https://example.com/par';

    $httpClient->mockResponse(
        HttpResponseGenerator::create(
            body: sprintf('{"request_uri": "%s", "expires_in": 90}', $mockRequestUri),
            statusCode: 201,
            headers: ['Content-Type' => 'application/json']
        ),
    );

    $authentication->pushedAuthorizationRequest()->create();
    $request = $httpClient->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();

    parse_str((string) $request->getBody(), $requestBody);

    expect($requestBody)
        ->toBeArray()
        ->toHaveKey('client_id', $this->configuration->getClientId())
        ->toHaveKey('client_assertion_type', Authentication::CONST_CLIENT_ASSERTION_TYPE)
        ->toHaveKey('client_assertion')
        ->not()->toHaveKey('client_secret');
});
