<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

class LogStreamsTest extends TestCase
{
    public function testGetAll(): void
    {
        $api = new MockManagementApi();

        $api->mock()->logStreams()->getAll();

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/log-streams', $api->getRequestUrl());
    }

    public function testGet(): void
    {
        $api = new MockManagementApi();

        $api->mock()->logStreams()->get('123');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/log-streams/123', $api->getRequestUrl());
    }

    public function testThatCreateLogStreamRequestIsFormedCorrectly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->logStreams()->create(
            'http',
            [
                'httpEndpoint' => 'https://me.org',
                'httpContentFormat' => 'JSONLINES',
                'httpContentType' => 'application/json',
                'httpAuthorization' => 'abc123',
            ],
            'Test Stream'
        );

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/log-streams', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
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
        $api = new MockManagementApi();

        $api->mock()->logStreams()->update(
            '123',
            ['name' => 'Test Name']
        );

        $this->assertEquals('PATCH', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/log-streams/123', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals('Test Name', $body['name']);
    }

    public function testDelete(): void
    {
        $api = new MockManagementApi();

        $api->mock()->logStreams()->delete('123');

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/log-streams/123', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }
}
