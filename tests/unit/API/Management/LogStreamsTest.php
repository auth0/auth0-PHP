<?php

declare(strict_types=1);

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

class LogStreamsTest extends ApiTests
{
    /**
     * Expected telemetry value.
     */
    protected static string $expectedTelemetry;

    /**
     * Default request headers.
     */
    protected static array $headers = ['content-type' => 'json'];

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass(): void
    {
        $infoHeadersData = new InformationHeaders();
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    public function testGetAll(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->logStreams()->getAll();

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/log-streams', $api->getHistoryUrl());
    }

    public function testGet(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->logStreams()->get('123');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/log-streams/123', $api->getHistoryUrl());
    }

    public function testThatCreateLogStreamRequestIsFormedCorrectly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->logStreams()->create(
            'http',
            [
                'httpEndpoint' => 'https://me.org',
                'httpContentFormat' => 'JSONLINES',
                'httpContentType' => 'application/json',
                'httpAuthorization' => 'abc123',
            ],
            'Test Stream'
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/log-streams', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals('Test Stream', $body['name']);
        $this->assertArrayHasKey('type', $body);
        $this->assertEquals('http', $body['type']);
        $this->assertArrayHasKey('sink', $body);
        $this->assertEquals('https://me.org', $body['sink']['httpEndpoint']);
        $this->assertEquals('JSONLINES', $body['sink']['httpContentFormat']);
        $this->assertEquals('application/json', $body['sink']['httpContentType']);
        $this->assertEquals('abc123', $body['sink']['httpAuthorization']);
    }

    public function testUpdate(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->logStreams()->update(
            '123',
            ['name' => 'Test Name']
        );

        $this->assertEquals('PATCH', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/log-streams/123', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals('Test Name', $body['name']);
    }

    public function testDelete(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->logStreams()->delete('123');

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/log-streams/123', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }
}
