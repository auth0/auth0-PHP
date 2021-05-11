<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class GrantsTestMocked.
 */
class GrantsMockedTest extends TestCase
{
    /**
     * Expected telemetry value.
     */
    protected static string $telemetry;

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
     */
    public function testGet(): void
    {
        $api = new MockManagementApi([new Response(200)]);

        $api->call()->grants()->getAll();

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/grants', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());
    }

    /**
     * Test that getByClientId adds a client_id to the request.
     */
    public function testGetByClientId(): void
    {
        $api = new MockManagementApi([new Response(200)]);

        $api->call()->grants()->getAllByClientId('__test_client_id__');

        $this->assertStringStartsWith('https://api.test.local/api/v2/grants', $api->getHistoryUrl());
        $this->assertEquals('client_id=__test_client_id__', $api->getHistoryQuery());
    }

    /**
     * Test that getByAudience adds an audience to the request.
     */
    public function testGetByAudience(): void
    {
        $api = new MockManagementApi([new Response(200)]);

        $api->call()->grants()->getAllByAudience('__test_audience__');

        $this->assertStringStartsWith('https://api.test.local/api/v2/grants', $api->getHistoryUrl());
        $this->assertEquals('audience=__test_audience__', $api->getHistoryQuery());
    }

    /**
     * Test that getByUserId adds an audience to the request.
     */
    public function testGetByUserId(): void
    {
        $api = new MockManagementApi([new Response(200)]);

        $api->call()->grants()->getAllByUserId('__test_user_id__');

        $this->assertStringStartsWith('https://api.test.local/api/v2/grants', $api->getHistoryUrl());
        $this->assertEquals('user_id=__test_user_id__', $api->getHistoryQuery());
    }

    /**
     * Test that delete requests properly.
     */
    public function testDelete(): void
    {
        $api = new MockManagementApi([new Response(204)]);

        $id = uniqid();
        $api->call()->grants()->delete($id);

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/grants/' . $id, $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());
    }
}
