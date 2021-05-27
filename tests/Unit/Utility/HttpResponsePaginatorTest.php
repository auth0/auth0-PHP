<?php

declare(strict_types=1);

use Auth0\SDK\Exception\NetworkException;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Auth0\Tests\Utilities\MockManagementApi;

uses()->group('network')->group('pagination');

test('returns a count of 0 when there are no results', function(): void {
    $sdk = (new MockManagementApi())->mock();
    $this->paginator = $sdk->getResponsePaginator();

    $this->assertEquals(0, count($this->paginator));
});

test('returns a count when there are results', function(): void {
    $sdk = (new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'start' => 0,
            'total' => 2,
            'limit' => 2,
            'length' => 2,
            'users' => ['user1', 'user2']
        ]))
    ]))->mock();

    $sdk->users()->getAll();
    $this->paginator = $sdk->getResponsePaginator();

    $this->assertEquals(2, count($this->paginator));
});

test('fails when used with a non-GET api request', function(): void {
    $sdk = (new MockManagementApi())->mock();
    $sdk->users()->create(uniqid(), [uniqid()]);

    $this->expectException(\Auth0\SDK\Exception\PaginatorException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\PaginatorException::MSG_HTTP_METHOD_UNSUPPORTED);

    $this->paginator = $sdk->getResponsePaginator();
});

test('returns loaded results', function(): void {
    $sdk = (new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'start' => 0,
            'total' => 3,
            'limit' => 3,
            'length' => 3,
            'users' => ['user1', 'user2', 'user3']
        ]))
    ]))->mock();

    $sdk->users()->getAll();
    $this->paginator = $sdk->getResponsePaginator();

    $this->assertEquals(3, count($this->paginator));

    foreach ($this->paginator as $index => $result) {
        $this->assertEquals('user' . ($index + 1), $result);
    }
});

test('sends network requests for paginated results', function(): void {
    $sdk = (new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'start' => 0,
            'total' => 4,
            'limit' => 2,
            'length' => 2,
            'users' => ['user1', 'user2']
        ])),
        HttpResponseGenerator::create(json_encode([
            'start' => 2,
            'total' => 4,
            'limit' => 2,
            'length' => 2,
            'users' => ['user3', 'user4']
        ])),
    ]))->mock();

    $sdk->users()->getAll();
    $this->paginator = $sdk->getResponsePaginator();

    $this->assertEquals(4, count($this->paginator));

    foreach ($this->paginator as $index => $result) {
        $this->assertEquals('user' . ($index + 1), $result);
    }

    $this->assertEquals(1, $this->paginator->countNetworkRequests());
});

test('recreates an http request that was issued without pagination', function(): void {
    $sdk = (new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'user1', 'user2'
        ])),
        HttpResponseGenerator::create(json_encode([
            'start' => 0,
            'total' => 2,
            'limit' => 2,
            'length' => 2,
            'users' => ['user1', 'user2']
        ]))
    ]))->mock();

    $sdk->users()->getAll();
    $this->paginator = $sdk->getResponsePaginator();

    $this->assertEquals(2, count($this->paginator));

    foreach ($this->paginator as $index => $result) {
        $this->assertEquals('user' . ($index + 1), $result);
    }

    $this->assertEquals(1, $this->paginator->countNetworkRequests());
});

test('silently exits iteration after network error', function(): void {
    $sdk = new MockManagementApi([
        HttpResponseGenerator::create(json_encode([
            'start' => 0,
            'total' => 200,
            'limit' => 1,
            'length' => 1,
            'users' => ['user1']
        ]))
    ]);

    $sdk->getHttpClient()->mockResponse(
        HttpResponseGenerator::create('', 500),
        null,
        NetworkException::requestFailed('Mocked network failure.')
    );

    $sdk = $sdk->mock();

    $sdk->users()->getAll();
    $this->paginator = $sdk->getResponsePaginator();

    foreach ($this->paginator as $index => $result) {
        $this->assertEquals('user' . ($index + 1), $result);
    }

    $this->assertEquals(200, count($this->paginator));
    $this->assertEquals(1, $this->paginator->countNetworkRequests());
});
