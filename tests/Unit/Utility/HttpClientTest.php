<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\SDK\Utility\HttpResponse;
use Auth0\Tests\Utilities\HttpResponseGenerator;

uses()->group('utility', 'networking');

beforeEach(function(): void {
    $this->config = new SdkConfiguration([
        'domain' => 'api.local.test',
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    $this->client = new HttpClient($this->config, HttpClient::CONTEXT_MANAGEMENT_CLIENT);

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

test('an exponential back-off and jitter are being applied', function(): void {
    $this->config->setHttpMaxRetries(10);
    $baseWaits = [0];
    $baseWaitSum = 0;

    for ($i=0; $i < 10; $i++) {
        $this->client->mockResponse(clone $this->httpResponse429);
        $baseWait = intval(100 * pow(2, $i));
        $baseWaits[] = $baseWait;
        $baseWaitSum = $baseWaitSum + $baseWait;
    }

    $response = $this->client->method('get')
        ->addPath('client')
        ->call();

    $requestCount = $this->client->getLastRequest()->getRequestCount();
    $requestDelays = $this->client->getLastRequest()->getRequestDelays();

    $this->assertEquals(429, HttpResponse::getStatusCode($response));
    $this->assertEquals(10, $requestCount);
    $this->assertEquals(10, count($requestDelays));

    // Assert that exponential backoff is happening.
    $this->assertGreaterThanOrEqual($requestDelays[0], $requestDelays[1]);
    $this->assertGreaterThanOrEqual($requestDelays[1], $requestDelays[2]);
    $this->assertGreaterThanOrEqual($requestDelays[2], $requestDelays[3]);
    $this->assertGreaterThanOrEqual($requestDelays[3], $requestDelays[4]);
    $this->assertGreaterThanOrEqual($requestDelays[4], $requestDelays[5]);
    $this->assertGreaterThanOrEqual($requestDelays[5], $requestDelays[6]);
    $this->assertGreaterThanOrEqual($requestDelays[6], $requestDelays[7]);
    $this->assertGreaterThanOrEqual($requestDelays[7], $requestDelays[8]);
    $this->assertGreaterThanOrEqual($requestDelays[8], $requestDelays[9]);

    // Ensure jitter is being applied.
    $this->assertNotEquals($baseWaits[1], $requestDelays[1]);
    $this->assertNotEquals($baseWaits[2], $requestDelays[2]);
    $this->assertNotEquals($baseWaits[3], $requestDelays[3]);
    $this->assertNotEquals($baseWaits[4], $requestDelays[4]);
    $this->assertNotEquals($baseWaits[5], $requestDelays[5]);
    $this->assertNotEquals($baseWaits[6], $requestDelays[6]);
    $this->assertNotEquals($baseWaits[7], $requestDelays[7]);
    $this->assertNotEquals($baseWaits[8], $requestDelays[8]);
    $this->assertNotEquals($baseWaits[9], $requestDelays[9]);

    // Ensure subsequent delay is never less than the minimum.
    $this->assertGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY, $requestDelays[1]);
    $this->assertGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY, $requestDelays[2]);
    $this->assertGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY, $requestDelays[3]);
    $this->assertGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY, $requestDelays[4]);
    $this->assertGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY, $requestDelays[5]);
    $this->assertGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY, $requestDelays[6]);
    $this->assertGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY, $requestDelays[7]);
    $this->assertGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY, $requestDelays[8]);
    $this->assertGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY, $requestDelays[9]);

    // Ensure delay is never more than the maximum.
    $this->assertLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY, $requestDelays[0]);
    $this->assertLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY, $requestDelays[1]);
    $this->assertLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY, $requestDelays[2]);
    $this->assertLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY, $requestDelays[3]);
    $this->assertLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY, $requestDelays[4]);
    $this->assertLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY, $requestDelays[5]);
    $this->assertLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY, $requestDelays[6]);
    $this->assertLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY, $requestDelays[7]);
    $this->assertLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY, $requestDelays[8]);
    $this->assertLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY, $requestDelays[9]);

    // Ensure total delay sum is never more than 10s.
    $this->assertLessThanOrEqual(10000, array_sum($requestDelays));
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
