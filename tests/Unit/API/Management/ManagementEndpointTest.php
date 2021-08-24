<?php

declare(strict_types=1);

use Auth0\SDK\API\Management\ManagementEndpoint;
use Auth0\SDK\API\Management\Users;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\SDK\Utility\HttpResponsePaginator;
use Auth0\SDK\Utility\Request\PaginatedRequest;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\Tests\Utilities\HttpResponseGenerator;

uses()->group('management', 'management.generic');

beforeEach(function(): void {
    $this->configuration = new SdkConfiguration([
        'strategy' => 'none',
        'domain' => 'api.local.test'
    ]);

    $this->httpClient = new HttpClient($this->configuration,  HttpClient::CONTEXT_GENERIC_CLIENT);
    $this->endpoint = new class($this->httpClient) extends ManagementEndpoint {};
});

test('getHttpClient() returns an HttpClient instance', function(): void {
    $this->assertInstanceOf(HttpClient::class, $this->endpoint->getHttpClient());
});

test('getLastRequest() returns null when no requests have been made', function(): void {
    $this->assertNull($this->endpoint->getLastRequest());
});

test('getLastRequest() returns an HttpRequest instance', function(): void {
    $client = new Users($this->httpClient);
    $client->getAll();

    $this->assertInstanceOf(HttpRequest::class, $client->getLastRequest());
});

test('getResponsePaginator() returns an HttpResponsePaginator instance', function(): void {
    $this->httpClient->mockResponse(HttpResponseGenerator::create(json_encode([
        'start' => 0,
        'total' => 3,
        'limit' => 3,
        'length' => 3,
        'users' => [uniqid(), uniqid(), uniqid()],
    ])));

    $client = new Users($this->httpClient);
    $response = $client->getAll(null, new RequestOptions(null, new PaginatedRequest(0, 5, true)));

    $this->assertInstanceOf(HttpResponsePaginator::class, $client->getResponsePaginator());
});

test('getResponsePaginator() throws an exception when a request has not been made', function(): void {
    $this->expectException(\Auth0\SDK\Exception\PaginatorException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\PaginatorException::MSG_HTTP_BAD_RESPONSE);

    $this->assertInstanceOf(HttpResponsePaginator::class, $this->endpoint->getResponsePaginator());
});
