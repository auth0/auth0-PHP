<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\SDK\Utility\HttpResponse;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Discovery\Strategy\MockClientStrategy;

uses()->group('utility', 'networking');

beforeEach(function(): void {
    // Allow mock HttpClient to be auto-discovered for use in testing.
    Psr18ClientDiscovery::prependStrategy(MockClientStrategy::class);

    $this->config = new SdkConfiguration([
        'domain' => 'api.local.test',
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    $this->client = new HttpClient($this->config);
});

test('a 429 response is not retried if httpMaxRetries is zero', function(): void {
    $this->config->setHttpMaxRetries(0);

    $this->client->mockResponses([
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
    ]);

    $response = $this->client->method('get')
        ->addPath('client')
        ->call();

    $this->assertEquals(429, HttpResponse::getStatusCode($response));

    $requestCount = $this->client->getLastRequest()->getRequestCount();

    $this->assertEquals(1, $requestCount);
});

test('a 429 response is not retried more than the hard cap', function(): void {
    $this->config->setHttpMaxRetries(HttpRequest::MAX_REQUEST_RETRIES * 2);

    $this->client->mockResponses([
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
    ]);

    $response = $this->client->method('get')
        ->addPath('client')
        ->call();

    $this->assertEquals(429, HttpResponse::getStatusCode($response));

    $requestCount = $this->client->getLastRequest()->getRequestCount();

    $this->assertEquals(10, $requestCount);
});

test('a request is tried 3 times before failing in the event of a 429', function(): void {
    $this->client->mockResponses([
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"status": "OK"}', 200)
    ]);

    $response = $this->client->method('get')
        ->addPath('client')
        ->call();

    $this->assertEquals(429, HttpResponse::getStatusCode($response));

    $requestCount = $this->client->getLastRequest()->getRequestCount();

    $this->assertEquals(3, $requestCount);
});

test('a request recovers from a 429 response and returns the successful result', function(): void {
    $this->client->mockResponses([
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
        HttpResponseGenerator::create('{"status": "OK"}', 200),
        HttpResponseGenerator::create('{"error": "access_denied or too_many_requests", "error_description": "Global rate limit exceeded"}', 429),
    ]);

    $response = $this->client->method('get')
        ->addPath('client')
        ->call();

    $this->assertEquals(200, HttpResponse::getStatusCode($response));

    $requestCount = $this->client->getLastRequest()->getRequestCount();

    $this->assertEquals(2, $requestCount);
});
