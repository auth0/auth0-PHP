<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

/**
 * Class ClientsTest.
 */
class ClientsTest extends TestCase
{
    /**
     * Test getAll() request.
     */
    public function testGetAll(): void
    {
        $api = new MockManagementApi();
        $api->mock()->clients()->getAll(['client_id' => '__test_client_id__', 'app_type' => '__test_app_type__']);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/clients', $api->getRequestUrl());

        $query = $api->getRequestQuery();
        $this->assertStringContainsString('&client_id=__test_client_id__&app_type=__test_app_type__', $query);
    }

    /**
     * Test get() request.
     */
    public function testGet(): void
    {
        $api = new MockManagementApi();
        $api->mock()->clients()->get('__test_id__');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/clients/__test_id__', $api->getRequestUrl());
    }

    /**
     * Test delete() request.
     */
    public function testDelete(): void
    {
        $api = new MockManagementApi();
        $api->mock()->clients()->delete('__test_id__');

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/clients/__test_id__', $api->getRequestUrl());
    }

    /**
     * Test create() request.
     */
    public function testCreate(): void
    {
        $mock = (object) [
            'name' => uniqid(),
            'body'=> [
                'app_type' => uniqid()
            ]
        ];

        $api = new MockManagementApi();
        $api->mock()->clients()->create($mock->name, $mock->body);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/clients', $api->getRequestUrl());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals($mock->name, $body['name']);
        $this->assertArrayHasKey('app_type', $body);
        $this->assertEquals($mock->body['app_type'], $body['app_type']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(array_merge(['name' => $mock->name], $mock->body)), $body);
    }

    /**
     * Test update() request.
     */
    public function testUpdate(): void
    {
        $api = new MockManagementApi();
        $api->mock()->clients()->update('__test_id__', ['name' => '__test_new_name__']);

        $this->assertEquals('PATCH', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/clients/__test_id__', $api->getRequestUrl());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals('__test_new_name__', $body['name']);
    }
}
