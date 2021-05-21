<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

/**
 * Class GrantsTestMocked.
 */
class GrantsMockedTest extends TestCase
{
    /**
     * Test that getAll requests properly.
     */
    public function testGet(): void
    {
        $api = new MockManagementApi();
        $request = $api->mock()->grants()->getAll();

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/grants', $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());
    }

    /**
     * Test that getByClientId adds a client_id to the request.
     */
    public function testGetByClientId(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->grants()->getAllByClientId($id);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/grants', $api->getRequestUrl());
        $this->assertEquals('client_id=' . $id, $api->getRequestQuery(null));
    }

    /**
     * Test that getByAudience adds an audience to the request.
     */
    public function testGetByAudience(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->grants()->getAllByAudience($id);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/grants', $api->getRequestUrl());
        $this->assertEquals('audience=' . $id, $api->getRequestQuery(null));
    }

    /**
     * Test that getByUserId adds an audience to the request.
     */
    public function testGetByUserId(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->grants()->getAllByUserId($id);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/grants', $api->getRequestUrl());
        $this->assertEquals('user_id=' . $id, $api->getRequestQuery(null));
    }

    /**
     * Test that delete requests properly.
     */
    public function testDelete(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->grants()->delete($id);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/grants/' . $id, $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());
    }
}
