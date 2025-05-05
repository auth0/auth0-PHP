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

test('parseQuotaBuckets() returns expected buckets array for full input', function(): void {
    $raw = 'b=per_hour;q=100;r=99;t=1,b=per_day;q=300;r=299;t=1';

    $buckets = HttpResponse::parseQuotaBuckets($raw);

    // We should have both buckets
    $this->assertArrayHasKey('per_hour', $buckets);
    $this->assertArrayHasKey('per_day', $buckets);

    // And their values must match
    expect($buckets['per_hour']['quota'])->toEqual(100);
    expect($buckets['per_hour']['remaining'])->toEqual(99);
    expect($buckets['per_hour']['time'])->toEqual(1);

    expect($buckets['per_day']['quota'])->toEqual(300);
    expect($buckets['per_day']['remaining'])->toEqual(299);
    expect($buckets['per_day']['time'])->toEqual(1);
});

test('parseQuotaBuckets() handles missing parts', function(): void {
    $raw = 'b=per_minute;r=50';

    $buckets = HttpResponse::parseQuotaBuckets($raw);

    $this->assertArrayHasKey('per_minute', $buckets);

    expect($buckets['per_minute']['quota'])->toBeNull();
    expect($buckets['per_minute']['remaining'])->toEqual(50);
    expect($buckets['per_minute']['time'])->toBeNull();
});

test('parseQuotaHeaders() returns structured data for client + organization + rateLimit', function(): void {
    $clientRaw = 'b=per_hour;q=10;r=5;t=2';
    $orgRaw    = 'b=per_day;q=20;r=18;t=24';

    $headers = [
        'Auth0-Client-Quota-Limit'       => [ $clientRaw ],
        'Auth0-Organization-Quota-Limit' => [ $orgRaw ],
        'Retry-After'                    => [ '30' ],
        'X-RateLimit-Limit'              => [ '1000' ],
        'X-RateLimit-Remaining'          => [ '900' ],
        'X-RateLimit-Reset'              => [ '60' ],
    ];

    $response = HttpResponseGenerator::create('{}', 200, $headers);
    $parsed   = HttpResponse::parseQuotaHeaders($response);

    // Top-level keys
    $this->assertArrayHasKey('client', $parsed);
    $this->assertArrayHasKey('organization', $parsed);
    $this->assertArrayHasKey('retryAfter', $parsed);
    $this->assertArrayHasKey('rateLimit', $parsed);

    // retryAfter must be integer
    expect($parsed['retryAfter'])->toEqual(30);

    // Client bucket values
    $client = $parsed['client'];
    expect($client['per_hour']['quota'])->toEqual(10);
    expect($client['per_hour']['remaining'])->toEqual(5);
    expect($client['per_hour']['time'])->toEqual(2);

    // Org bucket values
    $org = $parsed['organization'];
    expect($org['per_day']['quota'])->toEqual(20);
    expect($org['per_day']['remaining'])->toEqual(18);
    expect($org['per_day']['time'])->toEqual(24);

    // Rate limit
    $rl = $parsed['rateLimit'];
    expect($rl['limit'])->toEqual(1000);
    expect($rl['remaining'])->toEqual(900);
    expect($rl['reset'])->toEqual(60);
});

test('parseQuotaHeaders() omits keys when headers are missing', function(): void {
    // No relevant headers at all
    $response = HttpResponseGenerator::create('{}', 200, []);
    $parsed   = HttpResponse::parseQuotaHeaders($response);

    $this->assertEmpty($parsed);
});
