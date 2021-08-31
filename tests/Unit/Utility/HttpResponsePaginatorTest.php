<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Request\PaginatedRequest;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Auth0\Tests\Utilities\MockManagementApi;

uses()->group('utility', 'utility.http_response_paginator', 'networking');

beforeEach(function(): void {
    $this->usePagination = new RequestOptions(null, new PaginatedRequest(0, 1, true));
});

test('throws an error when paginating without any request prepared', function(): void {
    $sdk = (new MockManagementApi())->mock();

    $this->expectException(\Auth0\SDK\Exception\PaginatorException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\PaginatorException::MSG_HTTP_BAD_RESPONSE);

    $this->paginator = $sdk->getResponsePaginator();
});

test('throws an error when attempting to initiate pagination on a failed network request', function(): void {
    $sdk = new MockManagementApi(null);

    $sdk->getHttpClient()->mockResponse(
        HttpResponseGenerator::create('', 500),
        null,
        \Auth0\SDK\Exception\NetworkException::requestFailed('Mocked network failure.')
    );

    $sdk = $sdk->mock();

    try {
        $sdk->users()->getAll();
    } catch (\Throwable $th) { // phpcs:ignore
        // Ignore the mocked network error.
    }

    $this->expectException(\Auth0\SDK\Exception\PaginatorException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\PaginatorException::MSG_HTTP_BAD_RESPONSE);

    $this->paginator = $sdk->getResponsePaginator();
});

test('returns a count of 0 when there are no results', function(): void {
    $sdk = (new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'start' => 0,
            'total' => 0,
            'limit' => 2,
            'length' => 0,
            'users' => [],
        ])),
    ]))->mock();

    $sdk->users()->getAll([], $this->usePagination);

    $this->paginator = $sdk->getResponsePaginator();

    expect(count($this->paginator))->toEqual(0);
});

test('returns a count when there are results', function(): void {
    $sdk = (new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'start' => 0,
            'total' => 2,
            'limit' => 2,
            'length' => 2,
            'users' => ['user1', 'user2'],
        ])),
    ]))->mock();

    $sdk->users()->getAll([], $this->usePagination);
    $this->paginator = $sdk->getResponsePaginator();

    expect(count($this->paginator))->toEqual(2);
});

test('throws an error when used with a non-GET endpoint', function(): void {
    $sdk = (new MockManagementApi())->mock();
    $sdk->users()->create(uniqid(), [uniqid()]);

    $this->expectException(\Auth0\SDK\Exception\PaginatorException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\PaginatorException::MSG_HTTP_METHOD_UNSUPPORTED);

    $this->paginator = $sdk->getResponsePaginator();
});

test('throws an error when used with an unsupported endpoint', function(): void {
    $sdk = (new MockManagementApi())->mock();
    $sdk->logStreams()->getAll();

    $this->expectException(\Auth0\SDK\Exception\PaginatorException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\PaginatorException::MSG_HTTP_BAD_RESPONSE);

    $this->paginator = $sdk->getResponsePaginator();
});

test('returns loaded results', function(): void {
    $sdk = (new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'start' => 0,
            'total' => 3,
            'limit' => 3,
            'length' => 3,
            'users' => ['user1', 'user2', 'user3'],
        ])),
    ]))->mock();

    $sdk->users()->getAll([], $this->usePagination);
    $this->paginator = $sdk->getResponsePaginator();

    expect(count($this->paginator))->toEqual(3);

    foreach ($this->paginator as $index => $result) {
        expect($result)->toEqual('user' . ($index + 1));
    }
});

test('returns network requests for paginated results', function(): void {
    $sdk = (new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'start' => 0,
            'total' => 4,
            'limit' => 2,
            'length' => 2,
            'users' => ['user1', 'user2'],
        ])),
        HttpResponseGenerator::create(json_encode([
            'start' => 2,
            'total' => 4,
            'limit' => 2,
            'length' => 2,
            'users' => ['user3', 'user4'],
        ])),
    ]))->mock();

    $sdk->users()->getAll();
    $this->paginator = $sdk->getResponsePaginator();

    expect(count($this->paginator))->toEqual(4);

    foreach ($this->paginator as $index => $result) {
        expect($result)->toEqual('user' . ($index + 1));
    }

    expect($this->paginator->countNetworkRequests())->toEqual(1);
});

test('ignores network errors and exits iteration', function(): void {
    $sdk = new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'start' => 0,
            'total' => 200,
            'limit' => 1,
            'length' => 1,
            'users' => ['user1'],
        ])),
    ]);

    $sdk->getHttpClient()->mockResponse(
        HttpResponseGenerator::create('', 500),
        null,
        \Auth0\SDK\Exception\NetworkException::requestFailed('Mocked network failure.')
    );

    $sdk = $sdk->mock();

    $sdk->users()->getAll();
    $this->paginator = $sdk->getResponsePaginator();

    foreach ($this->paginator as $index => $result) {
        expect($result)->toEqual('user' . ($index + 1));
    }

    expect(count($this->paginator))->toEqual(200);
    expect($this->paginator->countNetworkRequests())->toEqual(1);
});

test('uses checkpoint pagination params when appropriate', function(): void {
    $sdk = (new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'organizations' => ['org1', 'org2'],
            'next' => 'test1',
        ])),
        HttpResponseGenerator::create(json_encode([
            'organizations' => ['org3', 'org4'],
            'next' => 'test2',
        ])),
        HttpResponseGenerator::create(json_encode([
            'organizations' => ['org5', 'org6'],
        ])),
    ]))->mock();

    $pagination = (new PaginatedRequest())->setTake(2);

    $sdk->organizations()->getAll(new RequestOptions(null, $pagination));
    $this->paginator = $sdk->getResponsePaginator();

    foreach ($this->paginator as $index => $result) {
        expect($result)->toEqual('org' . ($index + 1));
    }

    expect($this->paginator->countNetworkRequests())->toEqual(2);

    $this->expectException(\Auth0\SDK\Exception\PaginatorException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\PaginatorException::MSG_HTTP_CANNOT_COUNT_CHECKPOINT_PAGINATION);

    count($this->paginator);
});

test('throws an error if checkpoint pagination is used on an unsupported endpoint', function(): void {
    $sdk = (new MockManagementApi())->mock();
    $pagination = (new PaginatedRequest())->setTake(2);
    $sdk->users()->getAll([], new RequestOptions(null, $pagination));

    $badEndpointPath = $sdk->getLastRequest()->getLastRequest()->getUri()->getPath();

    $this->expectException(\Auth0\SDK\Exception\PaginatorException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\PaginatorException::MSG_HTTP_ENDPOINT_DOES_NOT_SUPPORT_CHECKPOINT_PAGINATION, $badEndpointPath));

    $this->paginator = $sdk->getResponsePaginator();
});
