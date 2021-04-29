<?php

declare(strict_types=1);

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\Tests\API\ApiTests;
use Auth0\Tests\Traits\ErrorHelpers;
use GuzzleHttp\Psr7\Response;

/**
 * Class GuardianTest.
 */
class GuardianTest extends ApiTests
{
    use ErrorHelpers;

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
     * Test that getFactors requests properly.
     */
    public function testGuardianGetFactor(): void
    {
        $api = new MockManagementApi([new Response(200)]);

        $api->call()->guardian()->getFactors();

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/guardian/factors', $api->getHistoryUrl());
        $this->assertEmpty($api->getHistoryQuery());
    }

    /**
     * Test that getEnrollment requests properly.
     */
    public function testGuardianGetEnrollment(): void
    {
        $api = new MockManagementApi([new Response(200)]);

        $api->call()->guardian()->getEnrollment('__test_factor_id__');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/guardian/enrollments/__test_factor_id__',
            $api->getHistoryUrl()
        );
        $this->assertEmpty($api->getHistoryQuery());
    }

    /**
     * Test that deleteEnrollment requests properly.
     */
    public function testGuardianDeleteEnrollment(): void
    {
        $api = new MockManagementApi([new Response(200)]);

        $api->call()->guardian()->deleteEnrollment('__test_factor_id__');

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals(
            'https://api.test.local/api/v2/guardian/enrollments/__test_factor_id__',
            $api->getHistoryUrl()
        );
        $this->assertEmpty($api->getHistoryQuery());
    }
}
