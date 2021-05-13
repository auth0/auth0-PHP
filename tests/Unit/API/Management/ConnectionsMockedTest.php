<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class ConnectionsTestMocked.
 */
class ConnectionsMockedTest extends TestCase
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

    /**
     * Test a getAll() request.
     */
    public function testGetAll(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);
        $strategy = 'test-strategy-01';

        $api->call()->connections()->getAll([ 'strategy' => $strategy ]);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringContainsString('https://api.test.local/api/v2/connections', $api->getHistoryUrl());
        $this->assertStringContainsString('strategy=' . $strategy, $api->getHistoryQuery());
    }

    /**
     * Test a get() request.
     */
    public function testGet(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $id = 'con_testConnection10';
        $api->call()->connections()->get($id);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/connections/' . $id, $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());
    }

    /**
     * Test a basic delete connection request.
     */
    public function testDelete(): void
    {
        $api = new MockManagementApi([new Response(204)]);

        $id = 'con_testConnection10';
        $api->call()->connections()->delete($id);

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/connections/' . $id, $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());
    }

    /**
     * Test a delete user for connection request.
     */
    public function testDeleteUser(): void
    {
        $api = new MockManagementApi([new Response(204)]);

        $id = 'con_testConnection10';
        $email = 'con_testConnection10@auth0.com';
        $api->call()->connections()->deleteUser($id, $email);

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertStringContainsString('https://api.test.local/api/v2/connections/' . $id . '/users', $api->getHistoryUrl());
        $this->assertEquals('email=' . $email, $api->getHistoryQuery());
    }

    /**
     * Test a basic connection create call.
     */
    public function testCreate(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $name = 'TestConnection01';
        $strategy = 'test-strategy-01';
        $query = [ 'testing' => 'test '];

        $api->call()->connections()->create($name, $strategy, $query);
        $request_body = $api->getHistoryBody();

        $this->assertEquals($name, $request_body['name']);
        $this->assertEquals($strategy, $request_body['strategy']);
        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/connections', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());
    }

    /**
     * Test a basic update request.
     */
    public function testUpdate(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $id = 'con_testConnection10';
        $update_data = ['metadata' => ['meta1' => 'value1']];
        $api->call()->connections()->update($id, $update_data);
        $request_body = $api->getHistoryBody();

        $this->assertEquals($update_data, $request_body);
        $this->assertEquals('PATCH', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/connections/' . $id, $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());
    }
}
