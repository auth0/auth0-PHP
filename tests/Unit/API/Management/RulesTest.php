<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

/**
 * Class RulesTest.
 */
class RulesTest extends ApiTests
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
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->rules()->getAll(['enabled' => true]);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/rules', $api->getHistoryUrl());

        $query = $api->getHistoryQuery();
        $this->assertStringContainsString('enabled=true', $query);
    }

    /**
     * Test get() request.
     */
    public function testGet(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockupId = uniqid();

        $api->call()->rules()->get($mockupId);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/rules/' . $mockupId, $api->getHistoryUrl());
    }

    /**
     * Test delete() request.
     */
    public function testDelete(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockupId = uniqid();

        $api->call()->rules()->delete($mockupId);

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/rules/' . $mockupId, $api->getHistoryUrl());
    }

    /**
     * Test create() request.
     */
    public function testCreate(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'name' => uniqid(),
            'script' => uniqid(),
            'query' => [ 'test_parameter' => uniqid() ],
        ];

        $api->call()->rules()->create($mockup->name, $mockup->script, $mockup->query);

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/rules', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals($mockup->name, $body['name']);

        $this->assertArrayHasKey('script', $body);
        $this->assertEquals($mockup->script, $body['script']);

        $this->assertArrayHasKey('test_parameter', $body);
        $this->assertEquals($mockup->query['test_parameter'], $body['test_parameter']);
    }

    /**
     * Test update() request.
     */
    public function testUpdate(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $mockup = (object) [
            'id' => uniqid(),
            'query' => [ 'test_parameter' => uniqid() ],
        ];

        $api->call()->rules()->update($mockup->id, $mockup->query);

        $this->assertEquals('PATCH', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/rules/' . $mockup->id, $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('test_parameter', $body);
        $this->assertEquals($mockup->query['test_parameter'], $body['test_parameter']);
    }
}
