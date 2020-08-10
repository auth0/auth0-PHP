<?php
namespace Auth0\Tests\integration\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\API\Management;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

class BlacklistsIntegrationTest extends ApiTests
{

    /**
     * @throws \Auth0\SDK\Exception\ApiException
     */
    public function testBlacklistAndGet()
    {
        $env = self::getEnv();

        if (! $env['API_TOKEN']) {
            $this->markTestSkipped( 'No client secret; integration test skipped' );
        }

        $api      = new Management($env['API_TOKEN'], $env['DOMAIN']);
        $test_jti = uniqid().uniqid().uniqid();

        $api->blacklists()->blacklist($env['APP_CLIENT_ID'], $test_jti);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        $blacklisted = $api->blacklists()->getAll($env['APP_CLIENT_ID']);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        $this->assertGreaterThan( 0, count( $blacklisted ) );
        $this->assertEquals( $env['APP_CLIENT_ID'], $blacklisted[0]['aud'] );

        $found = false;
        foreach ($blacklisted as $token) {
            if ($test_jti === $token['jti']) {
                $found = true;
                break;
            }
        }

        $this->assertTrue( $found );
    }
}
