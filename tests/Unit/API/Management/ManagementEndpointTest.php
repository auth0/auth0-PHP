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
    expect($this->endpoint->getHttpClient())->toBeInstanceOf(HttpClient::class);
});

test('getLastRequest() returns null when no requests have been made', function(): void {
    expect($this->endpoint->getLastRequest())->toBeNull();
});

test('getLastRequest() returns an HttpRequest instance', function(): void {
    $client = new Users($this->httpClient);
    $client->getAll();

    expect($client->getLastRequest())->toBeInstanceOf(HttpRequest::class);
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

    expect($client->getResponsePaginator())->toBeInstanceOf(HttpResponsePaginator::class);
});

test('getResponsePaginator() throws an exception when a request has not been made', function(): void {
    expect($this->endpoint->getResponsePaginator())->toBeInstanceOf(HttpResponsePaginator::class);
})->throws(\Auth0\SDK\Exception\PaginatorException::class, \Auth0\SDK\Exception\PaginatorException::MSG_HTTP_BAD_RESPONSE);
