<?php

declare(strict_types=1);

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

/**
 * Class ClientsTest.
 */
class ClientsTest extends ApiTests
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
     * Test getAll() request.
     */
    public function testGetAll(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->clients()->getAll(['client_id' => '__test_client_id__', 'app_type' => '__test_app_type__']);

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/clients', $api->getHistoryUrl());

        $query = '&' . $api->getHistoryQuery();
        $this->assertStringContainsString('&client_id=__test_client_id__&app_type=__test_app_type__', $query);
    }

    /**
     * Test get() request.
     */
    public function testGet(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->clients()->get('__test_id__');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/clients/__test_id__', $api->getHistoryUrl());
    }

    /**
     * Test delete() request.
     */
    public function testDelete(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->clients()->delete('__test_id__');

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/clients/__test_id__', $api->getHistoryUrl());
    }

    /**
     * Test create() request.
     */
    public function testCreate(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->clients()->create('__test_name__', ['app_type' => '__test_app_type__']);

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/clients', $api->getHistoryUrl());

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals('__test_name__', $body['name']);
        $this->assertArrayHasKey('app_type', $body);
        $this->assertEquals('__test_app_type__', $body['app_type']);
    }

    /**
     * Test update() request.
     */
    public function testUpdate(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->clients()->update('__test_id__', ['name' => '__test_new_name__']);

        $this->assertEquals('PATCH', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/clients/__test_id__', $api->getHistoryUrl());

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('name', $body);
        $this->assertEquals('__test_new_name__', $body['name']);
    }
}
