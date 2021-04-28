<?php

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\API\Management;
use Auth0\SDK\Exception\CoreException;
use Auth0\Tests\Traits\ErrorHelpers;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class GrantsTestMocked.
 */
class GrantsMockedTest extends TestCase
{
    use ErrorHelpers;

    /**
     * Expected telemetry value.
     *
     * @var string
     */
    protected static $telemetry;

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass(): void
    {
        $infoHeadersData = new InformationHeaders();
        $infoHeadersData->setCorePackage();
        self::$telemetry = $infoHeadersData->build();
    }

    /**
     * Test that getAll requests properly.
     *
     * @return void
     */
    public function testGet()
    {
        $api = new MockManagementApi([new Response(200)]);

        $api->call()->grants()->get();

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/grants', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());
    }

    /**
     * Test that getByClientId adds a client_id to the request.
     *
     * @return void
     */
    public function testGetByClientId()
    {
        $api = new MockManagementApi([new Response(200)]);

        $api->call()->grants()->getByClientId('__test_client_id__');

        $this->assertStringStartsWith('https://api.test.local/api/v2/grants', $api->getHistoryUrl());
        $this->assertEquals('client_id=__test_client_id__', $api->getHistoryQuery());
    }

    /**
     * Test that getByAudience adds an audience to the request.
     *
     * @return void
     */
    public function testGetByAudience()
    {
        $api = new MockManagementApi([new Response(200)]);

        $api->call()->grants()->getByAudience('__test_audience__');

        $this->assertStringStartsWith('https://api.test.local/api/v2/grants', $api->getHistoryUrl());
        $this->assertEquals('audience=__test_audience__', $api->getHistoryQuery());
    }

    /**
     * Test that getByUserId adds an audience to the request.
     *
     * @return void
     */
    public function testGetByUserId()
    {
        $api = new MockManagementApi([new Response(200)]);

        $api->call()->grants()->getByUserId('__test_user_id__');

        $this->assertStringStartsWith('https://api.test.local/api/v2/grants', $api->getHistoryUrl());
        $this->assertEquals('user_id=__test_user_id__', $api->getHistoryQuery());
    }

    /**
     * Test that delete requests properly.
     *
     * @return void
     */
    public function testDelete()
    {
        $api = new MockManagementApi([new Response(204)]);

        $id = uniqid();
        $api->call()->grants()->delete($id);

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/grants/' . $id, $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());
    }
}
