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

    $this->httpResponse200 = HttpResponseGenerator::create('{"status": "ok"}', 200);
    $this->httpResponse429 = HttpResponseGenerator::create('{"error": "too_many_requests", "error_description": "Rate limit exceeded"}', 429);
});

test('a 429 response is not retried if httpMaxRetries is zero', function(): void {
    $this->config->setHttpMaxRetries(0);

    for ($i=0; $i < 3; $i++) {
        $this->client->mockResponse(clone $this->httpResponse429);
    }

    $response = $this->client->method('get')
        ->addPath('client')
        ->call();

    $this->assertEquals(429, HttpResponse::getStatusCode($response));

    $requestCount = $this->client->getLastRequest()->getRequestCount();

    $this->assertEquals(1, $requestCount);
});

test('a 429 response is not retried more than the hard cap', function(): void {
    $this->config->setHttpMaxRetries(HttpRequest::MAX_REQUEST_RETRIES * 2);

    for ($i=0; $i < 11; $i++) {
        $this->client->mockResponse(clone $this->httpResponse429);
    }

    $response = $this->client->method('get')
        ->addPath('client')
        ->call();

    $this->assertEquals(429, HttpResponse::getStatusCode($response));

    $requestCount = $this->client->getLastRequest()->getRequestCount();

    $this->assertEquals(10, $requestCount);
});

test('an expontential backoff and jitter are being applied', function(): void {
    $this->config->setHttpMaxRetries(5);
    $baseWaits = [];

    for ($i=0; $i < 10; $i++) {
        $this->client->mockResponse(clone $this->httpResponse429);
        $baseWaits[] = intval(100 * pow(2, $i));
    }

    $response = $this->client->method('get')
        ->addPath('client')
        ->call();

    $requestCount = $this->client->getLastRequest()->getRequestCount();
    $requestDelays = $this->client->getLastRequest()->getRequestDelays();

    // Final mock API response was a 429.
    $this->assertEquals(429, HttpResponse::getStatusCode($response));

    // We made 5 requests.
    $this->assertEquals(5, $requestCount);

    // We triggered usleep() 4 times.
    $this->assertEquals(4, count($requestDelays));

    // Assert that exponential backoff is happening.
    $this->assertGreaterThanOrEqual($requestDelays[0], $requestDelays[1]);
    $this->assertGreaterThanOrEqual($requestDelays[1], $requestDelays[2]);
    $this->assertGreaterThanOrEqual($requestDelays[2], $requestDelays[3]);

    // Ensure jitter is being applied.
    $this->assertNotEquals($baseWaits[0], $requestDelays[0]);
    $this->assertNotEquals($baseWaits[1], $requestDelays[1]);
    $this->assertNotEquals($baseWaits[2], $requestDelays[2]);
    $this->assertNotEquals($baseWaits[3], $requestDelays[3]);
});

test('a request is tried 3 times before failing in the event of a 429', function(): void {
    for ($i=0; $i < 3; $i++) {
        $this->client->mockResponse(clone $this->httpResponse429);
    }

    $this->client->mockResponse(clone $this->httpResponse200);

    $response = $this->client->method('get')
        ->addPath('client')
        ->call();

    $this->assertEquals(429, HttpResponse::getStatusCode($response));

    $requestCount = $this->client->getLastRequest()->getRequestCount();

    $this->assertEquals(3, $requestCount);
});

test('a request recovers from a 429 response and returns the successful result', function(): void {
    $this->client->mockResponses([
        clone $this->httpResponse429,
        clone $this->httpResponse200,
        clone $this->httpResponse429
    ]);

    $response = $this->client->method('get')
        ->addPath('client')
        ->call();

    $this->assertEquals(200, HttpResponse::getStatusCode($response));

    $requestCount = $this->client->getLastRequest()->getRequestCount();

    $this->assertEquals(2, $requestCount);
});
