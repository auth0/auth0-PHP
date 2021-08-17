<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

/**
 * Class ConnectionsTest.
 */
class ConnectionsTest extends TestCase
{
    /**
     * Test a getAll() request.
     */
    public function testGetAll(): void
    {
        $strategy = 'test-strategy-01';

        $api = new MockManagementApi();
        $api->mock()->connections()->getAll([ 'strategy' => $strategy ]);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringContainsString('https://api.test.local/api/v2/connections', $api->getRequestUrl());
        $this->assertStringContainsString('&strategy=' . $strategy, $api->getRequestQuery());
    }

    /**
     * Test a get() request.
     */
    public function testGet(): void
    {
        $id = 'con_testConnection10';

        $api = new MockManagementApi();
        $api->mock()->connections()->get($id);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/connections/' . $id, $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());
    }

    /**
     * Test a basic delete connection request.
     */
    public function testDelete(): void
    {
        $id = 'con_testConnection10';

        $api = new MockManagementApi();
        $api->mock()->connections()->delete($id);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/connections/' . $id, $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());
    }

    /**
     * Test a delete user for connection request.
     */
    public function testDeleteUser(): void
    {
        $id = 'con_testConnection10';
        $email = 'con_testConnection10@auth0.com';

        $api = new MockManagementApi();
        $api->mock()->connections()->deleteUser($id, $email);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertStringContainsString('https://api.test.local/api/v2/connections/' . $id . '/users', $api->getRequestUrl());
        $this->assertEquals('email=' . rawurlencode($email), $api->getRequestQuery(null));
    }

    /**
     * Test a basic connection create call.
     */
    public function testCreate(): void
    {
        $mock = (object) [
            'name' => uniqid(),
            'strategy' => uniqid(),
            'body' => [
                'test1' => uniqid(),
                'test2' => uniqid()
            ]
        ];

        $api = new MockManagementApi();
        $api->mock()->connections()->create($mock->name, $mock->strategy, $mock->body);

        $request_body = $api->getRequestBody();

        $this->assertEquals($mock->name, $request_body['name']);
        $this->assertEquals($mock->strategy, $request_body['strategy']);
        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/connections', $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(array_merge(['name' => $mock->name, 'strategy' => $mock->strategy], $mock->body)), $body);
    }

    /**
     * Test a basic update request.
     */
    public function testUpdate(): void
    {
        $id = 'con_testConnection10';
        $update_data = ['metadata' => ['meta1' => 'value1']];

        $api = new MockManagementApi();
        $api->mock()->connections()->update($id, $update_data);

        $request_body = $api->getRequestBody();

        $this->assertEquals($update_data, $request_body);
        $this->assertEquals('PATCH', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/connections/' . $id, $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());
    }
}
