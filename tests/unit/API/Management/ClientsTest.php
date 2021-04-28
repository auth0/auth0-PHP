<?php

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\API\Management;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException as GlobalInvalidArgumentException;
use PHPUnit\Framework\Exception;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class ClientsTest.
 */
class ClientsTest extends ApiTests
{
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
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        $infoHeadersData = new InformationHeaders();
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    /**
     * Test getAll() request.
     *
     * @return void
     */
    public function testGetAll()
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
     *
     * @return void
     */
    public function testGet()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->clients()->get('__test_id__');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/clients/__test_id__', $api->getHistoryUrl());
    }

    /**
     * Test delete() request.
     *
     * @return void
     */
    public function testDelete()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->clients()->delete('__test_id__');

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/clients/__test_id__', $api->getHistoryUrl());
    }

    /**
     * Test create() request.
     *
     * @return void
     */
    public function testCreate()
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
     *
     * @return void
     */
    public function testUpdate()
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
