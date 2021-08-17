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
        $mock = (object) [
            'type' => uniqid(),
            'sink' => [
                'httpEndpoint' => uniqid(),
                'httpContentFormat' => uniqid(),
                'httpContentType' => uniqid(),
                'httpAuthorization' => uniqid(),
            ],
            'name' => uniqid(),
        ];

        $api = new MockManagementApi();

        $api->mock()->logStreams()->create($mock->type, $mock->sink, $mock->name);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/log-streams', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals($mock->name, $body['name']);
        $this->assertArrayHasKey('type', $body);
        $this->assertEquals($mock->type, $body['type']);
        $this->assertArrayHasKey('sink', $body);
        $this->assertEquals($mock->sink, $body['sink']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode($mock), $body);
    }

    public function testUpdate(): void
    {
        $mock = (object) [
            'id' => uniqid(),
            'body' => [
                'name' => uniqid()
            ]
        ];

        $api = new MockManagementApi();

        $api->mock()->logStreams()->update($mock->id, $mock->body);

        $this->assertEquals('PATCH', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/log-streams/' . $mock->id, $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals($mock->body['name'], $body['name']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode($mock->body), $body);
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
