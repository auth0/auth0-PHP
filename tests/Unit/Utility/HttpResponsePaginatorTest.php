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

it('throws an error when paginating without any request prepared', function(): void {
    $sdk = (new MockManagementApi())->mock();

    $paginator = $sdk->getResponsePaginator();
})->throws(\Auth0\SDK\Exception\PaginatorException::class, \Auth0\SDK\Exception\PaginatorException::MSG_HTTP_BAD_RESPONSE);

it('throws an error when attempting to initiate pagination on a failed network request', function(): void {
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

    $paginator = $sdk->getResponsePaginator();
})->throws(\Auth0\SDK\Exception\PaginatorException::class, \Auth0\SDK\Exception\PaginatorException::MSG_HTTP_BAD_RESPONSE);

it('throws an error when no start is returned from the API response', function(): void {
    $sdk = (new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'total' => 0,
            'limit' => 2,
            'length' => 0,
            'users' => [],
        ])),
    ]))->mock();

    $sdk->users()->getAll([], $this->usePagination);

    $paginator = $sdk->getResponsePaginator();

    expect(count($paginator))->toEqual(0);
})->throws(\Auth0\SDK\Exception\PaginatorException::class, \Auth0\SDK\Exception\PaginatorException::MSG_HTTP_BAD_RESPONSE);

it('returns a count of 0 when there are no results', function(): void {
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

    $paginator = $sdk->getResponsePaginator();

    expect(count($paginator))->toEqual(0);
});

it('returns a count when there are results', function(): void {
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
    $paginator = $sdk->getResponsePaginator();

    expect(count($paginator))->toEqual(2);
});

it('throws an error when used with a non-GET endpoint', function(): void {
    $sdk = (new MockManagementApi())->mock();
    $sdk->users()->create(uniqid(), [uniqid()]);

    $paginator = $sdk->getResponsePaginator();
})->throws(\Auth0\SDK\Exception\PaginatorException::class, \Auth0\SDK\Exception\PaginatorException::MSG_HTTP_METHOD_UNSUPPORTED);

it('throws an error when used with an unsupported endpoint', function(): void {
    $sdk = (new MockManagementApi())->mock();
    $sdk->logStreams()->getAll();

    $paginator = $sdk->getResponsePaginator();
})->throws(\Auth0\SDK\Exception\PaginatorException::class, \Auth0\SDK\Exception\PaginatorException::MSG_HTTP_BAD_RESPONSE);

it('returns loaded results', function(): void {
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
    $paginator = $sdk->getResponsePaginator();

    expect(count($paginator))->toEqual(3);

    foreach ($paginator as $index => $result) {
        expect($result)->toEqual('user' . ($index + 1));
    }
});

it('returns network requests for paginated results', function(): void {
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
    $paginator = $sdk->getResponsePaginator();

    expect(count($paginator))->toEqual(4);

    foreach ($paginator as $index => $result) {
        expect($result)->toEqual('user' . ($index + 1));
    }

    expect($paginator->countNetworkRequests())->toEqual(1);
});

it('ignores network errors and exits iteration', function(): void {
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
    $paginator = $sdk->getResponsePaginator();

    foreach ($paginator as $index => $result) {
        expect($result)->toEqual('user' . ($index + 1));
    }

    expect(count($paginator))->toEqual(200);
    expect($paginator->countNetworkRequests())->toEqual(1);
});

it('uses checkpoint pagination params when appropriate', function(): void {
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
    $paginator = $sdk->getResponsePaginator();

    foreach ($paginator as $index => $result) {
        expect($result)->toEqual('org' . ($index + 1));
    }

    expect($paginator->countNetworkRequests())->toEqual(2);

    count($paginator);
})->throws(\Auth0\SDK\Exception\PaginatorException::class, \Auth0\SDK\Exception\PaginatorException::MSG_HTTP_CANNOT_COUNT_CHECKPOINT_PAGINATION);

it('throws an error if checkpoint pagination is used on an unsupported endpoint', function(): void {
    $sdk = (new MockManagementApi())->mock();
    $pagination = (new PaginatedRequest())->setTake(2);
    $sdk->users()->getAll([], new RequestOptions(null, $pagination));

    $paginator = $sdk->getResponsePaginator();
})->throws(\Auth0\SDK\Exception\PaginatorException::class);

it('triggers checkpoint pagination on enabled regex endpoints', function(): void {
    $sdk = (new MockManagementApi())->mock();
    $sdk->organizations()->getMembers('xyz', new RequestOptions(null, (new PaginatedRequest())->setFrom('xyz')->setTake(2)));

    $paginator = $sdk->getResponsePaginator();
})->throws(\Auth0\SDK\Exception\PaginatorException::class);

it('checkpoint pagination stops iterating when a `next` response is not present', function(): void {
    $sdk = (new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'start' => 0,
            'total' => 2,
            'limit' => 1,
            'length' => 1,
            'users' => ['user1'],
        ])),
    ]))->mock();

    $sdk->organizations()->getAll(new RequestOptions(null, (new PaginatedRequest())->setTake(1)));
    $paginator = $sdk->getResponsePaginator();

    $paginator->next();
    $paginator->next();

    expect($paginator->current())->toBeFalse();
    expect($paginator->countNetworkRequests())->toEqual(0);
});
