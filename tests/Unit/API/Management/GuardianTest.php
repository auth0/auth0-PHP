<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

/**
 * Class GuardianTest.
 */
class GuardianTest extends TestCase
{
    /**
     * Test that getFactors requests properly.
     */
    public function testGuardianGetFactor(): void
    {
        $api = new MockManagementApi();
        $request = $api->mock()->guardian()->getFactors();

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/guardian/factors', $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());
    }

    /**
     * Test that getEnrollment requests properly.
     */
    public function testGuardianGetEnrollment(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->guardian()->getEnrollment($id);

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/guardian/enrollments/' . $id, $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());
    }

    /**
     * Test that deleteEnrollment requests properly.
     */
    public function testGuardianDeleteEnrollment(): void
    {
        $id = uniqid();

        $api = new MockManagementApi();
        $request = $api->mock()->guardian()->deleteEnrollment($id);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/guardian/enrollments/' . $id, $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());
    }
}
