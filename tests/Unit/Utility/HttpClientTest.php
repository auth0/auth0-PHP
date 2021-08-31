<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\SDK\Utility\HttpResponse;
use Auth0\Tests\Utilities\HttpResponseGenerator;

uses()->group('utility', 'utility.http_client', 'networking');

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

    expect(HttpResponse::getStatusCode($response))->toEqual(429);

    $requestCount = $this->client->getLastRequest()->getRequestCount();

    expect($requestCount)->toEqual(1);
});

test('a 429 response is not retried more than the hard cap', function(): void {
    $this->config->setHttpMaxRetries(HttpRequest::MAX_REQUEST_RETRIES * 2);

    for ($i=0; $i < 11; $i++) {
        $this->client->mockResponse(clone $this->httpResponse429);
    }

    $response = $this->client->method('get')
        ->addPath('client')
        ->call();

    expect(HttpResponse::getStatusCode($response))->toEqual(429);

    $requestCount = $this->client->getLastRequest()->getRequestCount();

    expect($requestCount)->toEqual(10);
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

    expect(HttpResponse::getStatusCode($response))->toEqual(429);
    expect($requestCount)->toEqual(10);
    expect(count($requestDelays))->toEqual(10);

    // Assert that exponential backoff is happening.
    expect($requestDelays[1])->toBeGreaterThanOrEqual($requestDelays[0]);
    expect($requestDelays[2])->toBeGreaterThanOrEqual($requestDelays[1]);
    expect($requestDelays[3])->toBeGreaterThanOrEqual($requestDelays[2]);
    expect($requestDelays[4])->toBeGreaterThanOrEqual($requestDelays[3]);
    expect($requestDelays[5])->toBeGreaterThanOrEqual($requestDelays[4]);
    expect($requestDelays[6])->toBeGreaterThanOrEqual($requestDelays[5]);
    expect($requestDelays[7])->toBeGreaterThanOrEqual($requestDelays[6]);
    expect($requestDelays[8])->toBeGreaterThanOrEqual($requestDelays[7]);
    expect($requestDelays[9])->toBeGreaterThanOrEqual($requestDelays[8]);

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
    expect($requestDelays[1])->toBeGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY);
    expect($requestDelays[2])->toBeGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY);
    expect($requestDelays[3])->toBeGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY);
    expect($requestDelays[4])->toBeGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY);
    expect($requestDelays[5])->toBeGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY);
    expect($requestDelays[6])->toBeGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY);
    expect($requestDelays[7])->toBeGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY);
    expect($requestDelays[8])->toBeGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY);
    expect($requestDelays[9])->toBeGreaterThanOrEqual(HttpRequest::MIN_REQUEST_RETRY_DELAY);

    // Ensure delay is never more than the maximum.
    expect($requestDelays[0])->toBeLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY);
    expect($requestDelays[1])->toBeLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY);
    expect($requestDelays[2])->toBeLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY);
    expect($requestDelays[3])->toBeLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY);
    expect($requestDelays[4])->toBeLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY);
    expect($requestDelays[5])->toBeLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY);
    expect($requestDelays[6])->toBeLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY);
    expect($requestDelays[7])->toBeLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY);
    expect($requestDelays[8])->toBeLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY);
    expect($requestDelays[9])->toBeLessThanOrEqual(HttpRequest::MAX_REQUEST_RETRY_DELAY);

    // Ensure total delay sum is never more than 10s.
    expect(array_sum($requestDelays))->toBeLessThanOrEqual(10000);
});

test('a request is tried 3 times before failing in the event of a 429', function(): void {
    for ($i=0; $i < 3; $i++) {
        $this->client->mockResponse(clone $this->httpResponse429);
    }

    $this->client->mockResponse(clone $this->httpResponse200);

    $response = $this->client->method('get')
        ->addPath('client')
        ->call();

    expect(HttpResponse::getStatusCode($response))->toEqual(429);

    $requestCount = $this->client->getLastRequest()->getRequestCount();

    expect($requestCount)->toEqual(3);
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

    expect(HttpResponse::getStatusCode($response))->toEqual(200);

    $requestCount = $this->client->getLastRequest()->getRequestCount();

    expect($requestCount)->toEqual(2);
});
