<?php
namespace Auth0\Tests\integration\API\Management;

use Auth0\SDK\API\Management;
use Auth0\Tests\API\ApiTests;

/**
 * Class GuardianTest.
 *
 * @package Auth0\Tests\integration\API\Management
 */
class GuardianIntegrationTest extends ApiTests
{

    /**
     * Test that getFactors requests properly.
     *
     * @return void
     *
     * @throws \Exception Should not be thrown in this test.
     */
    public function testIntegrationGuardianGetFactor()
    {
        $env = self::getEnv();

        if (! $env['API_TOKEN']) {
            $this->markTestSkipped( 'No client secret; integration test skipped' );
        }

        $api = new Management($env['API_TOKEN'], $env['DOMAIN']);
        $factors = $api->guardian()->getFactors();

        $this->assertIsArray($factors);
        $this->assertNotEmpty($factors);
    }
}
