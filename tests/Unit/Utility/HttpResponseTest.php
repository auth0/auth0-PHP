<?php

declare(strict_types=1);

use Auth0\SDK\Utility\HttpResponse;
use Psr\Http\Message\ResponseInterface;

uses()->group('utility', 'utility.http_response', 'networking');

test('getHeaders() returns the expected response', function(): void {
    $response = Mockery::mock(ResponseInterface::class);
    $response->shouldReceive('getStatusCode')->andReturn(200);
    $response->shouldReceive('getHeaders')->andReturn(['X-TEST' => 'Testing']);
    $response->shouldReceive('getBody')->andReturn('');

    expect(HttpResponse::getHeaders($response))
        ->toEqualCanonicalizing(['X-TEST' => 'Testing']);
});
