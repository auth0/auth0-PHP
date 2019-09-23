<?php
namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\API\Management;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

class BlacklistsTest extends ApiTests
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
    protected static $headers = [ 'content-type' => 'json' ];

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass()
    {
        $infoHeadersData = new InformationHeaders;
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    /**
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetAllRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->blacklists()->getAll( '__test_aud__' );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/blacklists/tokens', $api->getHistoryUrl() );

        $this->assertEquals( 'aud=__test_aud__', $api->getHistoryQuery() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatBlacklistRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->blacklists()->blacklist( '__test_aud__', '__test_jti__' );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/blacklists/tokens', $api->getHistoryUrl() );
        $this->assertEmpty( $api->getHistoryQuery() );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'aud', $body );
        $this->assertEquals( '__test_aud__', $body['aud'] );
        $this->assertArrayHasKey( 'jti', $body );
        $this->assertEquals( '__test_jti__', $body['jti'] );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
    }

    public function testThatMethodAndPropertyReturnSameClass()
    {
        $api = new Management(uniqid(), uniqid());
        $this->assertInstanceOf( Management\Blacklists::class, $api->blacklists );
        $this->assertInstanceOf( Management\Blacklists::class, $api->blacklists() );
        $api->blacklists = null;
        $this->assertInstanceOf( Management\Blacklists::class, $api->blacklists() );
    }

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
