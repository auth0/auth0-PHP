<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

/**
 * Class RulesTest.
 */
class RulesTest extends TestCase
{
    /**
     * Default request headers.
     */
    protected static array $headers = ['content-type' => 'json'];

    /**
     * Test getAll() request.
     */
    public function testGetAll(): void
    {
        $api = new MockManagementApi();

        $api->mock()->rules()->getAll(['enabled' => true]);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/rules', $api->getRequestUrl());

        $query = $api->getRequestQuery();
        $this->assertStringContainsString('enabled=true', $query);
    }

    /**
     * Test get() request.
     */
    public function testGet(): void
    {
        $api = new MockManagementApi();

        $mockupId = uniqid();

        $api->mock()->rules()->get($mockupId);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/rules/' . $mockupId, $api->getRequestUrl());
    }

    /**
     * Test delete() request.
     */
    public function testDelete(): void
    {
        $api = new MockManagementApi();

        $mockupId = uniqid();

        $api->mock()->rules()->delete($mockupId);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/rules/' . $mockupId, $api->getRequestUrl());
    }

    /**
     * Test create() request.
     */
    public function testCreate(): void
    {
        $api = new MockManagementApi();

        $mockup = (object) [
            'name' => uniqid(),
            'script' => uniqid(),
            'query' => [ 'test_parameter' => uniqid() ],
        ];

        $api->mock()->rules()->create($mockup->name, $mockup->script, $mockup->query);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/rules', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals($mockup->name, $body['name']);

        $this->assertArrayHasKey('script', $body);
        $this->assertEquals($mockup->script, $body['script']);

        $this->assertArrayHasKey('test_parameter', $body);
        $this->assertEquals($mockup->query['test_parameter'], $body['test_parameter']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(array_merge(['name' => $mockup->name, 'script' => $mockup->script], $mockup->query)), $body);
    }

    /**
     * Test update() request.
     */
    public function testUpdate(): void
    {
        $api = new MockManagementApi();

        $mockup = (object) [
            'id' => uniqid(),
            'query' => [ 'test_parameter' => uniqid() ],
        ];

        $api->mock()->rules()->update($mockup->id, $mockup->query);

        $this->assertEquals('PATCH', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/rules/' . $mockup->id, $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('test_parameter', $body);
        $this->assertEquals($mockup->query['test_parameter'], $body['test_parameter']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode($mockup->query), $body);
    }
}
