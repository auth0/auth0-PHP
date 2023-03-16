<?php

declare(strict_types=1);

use Auth0\SDK\Utility\HttpResponse;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Psr\Http\Message\ResponseInterface;

uses()->group('utility', 'utility.http_response', 'networking');

test('getHeaders() returns the expected response', function(): void {
    $headers = ['X-TEST' => uniqid()];
    $body = json_encode(['Hello World' => uniqid()]);

    $response = HttpResponseGenerator::create(
        $body,
        201,
        $headers
    );

    $headers = HttpResponse::getHeaders($response);
    $body = HttpResponse::getContent($response);
    $status = HttpResponse::getStatusCode($response);
    $success = HttpResponse::wasSuccessful($response, 201);

    expect($success)
        ->toBeTrue();

    expect($status)
        ->toEqual(201);

    expect($body)
        ->toEqual($body);

    expect($headers)
        ->toHaveKeys(['X-TEST'])
        ->each->toEqual($headers['X-TEST']);
});

test('getContent() returns the expected response', function(): void {
    $response = $this->createMock(ResponseInterface::class);
    $response->method('getBody')->willReturn(123);

    expect(HttpResponse::getContent($response))
        ->toEqual('123');
});

test('decodeContent() returns the expected response', function(): void {
    $response = $this->createMock(ResponseInterface::class);
    $response->method('getBody')->willReturn(json_encode(['Hello World' => uniqid()]));

    expect(HttpResponse::decodeContent($response))
        ->toBeArray()
        ->toHaveKey('Hello World');
});
