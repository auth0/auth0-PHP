<?php

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\Tests\Traits\ErrorHelpers;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class ConnectionsTestMocked.
 */
class ConnectionsMockedTest extends TestCase
{
    use ErrorHelpers;

    /**
     * Expected telemetry value.
     *
     * @var string
     */
    protected static $expectedTelemetry;

    /**
     * Default request headers.
     *
     * @var array
     */
    protected static $headers = ['content-type' => 'json'];

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
     *
     * @return void
     */
    public function testGetAll()
    {
        $api      = new MockManagementApi([new Response(200, self::$headers)]);
        $strategy = 'test-strategy-01';

        $api->call()->connections()->getAll([ 'strategy' => $strategy ]);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringContainsString('https://api.test.local/api/v2/connections', $api->getHistoryUrl());
        $this->assertStringContainsString('strategy=' . $strategy, $api->getHistoryQuery());
    }

    /**
     * Test a get() request.
     *
     * @return void
     */
    public function testGet()
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
     *
     * @return void
     */
    public function testDelete()
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
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $api = new MockManagementApi([new Response(204)]);

        $id    = 'con_testConnection10';
        $email = 'con_testConnection10@auth0.com';
        $api->call()->connections()->deleteUser($id, $email);

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertStringContainsString('https://api.test.local/api/v2/connections/' . $id . '/users', $api->getHistoryUrl());
        $this->assertEquals('email=' . $email, $api->getHistoryQuery());
    }

    /**
     * Test a basic connection create call.
     *
     * @return void
     */
    public function testCreate()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $name     = 'TestConnection01';
        $strategy = 'test-strategy-01';
        $query    = [ 'testing' => 'test '];

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
     *
     * @return void
     */
    public function testUpdate()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $id          = 'con_testConnection10';
        $update_data = ['metadata' => ['meta1' => 'value1']];
        $api->call()->connections()->update($id, $update_data);
        $request_body = $api->getHistoryBody();

        $this->assertEquals($update_data, $request_body);
        $this->assertEquals('PATCH', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/connections/' . $id, $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());
    }
}
