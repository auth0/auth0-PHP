<?php

namespace Auth0\Tests\API\Management;

use Auth0\Tests\Traits\ErrorHelpers;
use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\API\Management;
use GuzzleHttp\Psr7\Response;

/**
 * Class EmailsMockedTest
 *
 * @package Auth0\Tests\API\Management
 */
class EmailsMockedTest extends \PHPUnit_Framework_TestCase
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

    public function testThatMethodAndPropertyReturnSameClass()
    {
        $api = new Management(uniqid(), uniqid());
        $this->assertInstanceOf( Management\Emails::class, $api->emails );
        $this->assertInstanceOf( Management\Emails::class, $api->emails() );
        $api->emails = null;
        $this->assertInstanceOf( Management\Emails::class, $api->emails() );
    }

    /**
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetEmailProviderRequestIsFormattedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );
        $api->call()->emails()->getEmailProvider();

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/emails/provider', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * @throws \Exception Should not be thrown in this test.
     */
    public function testThatGetEmailProviderRequestAddsFieldsParams()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );
        $api->call()->emails()->getEmailProvider( [ 'name', 'credentials' ], true );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/emails/provider', $api->getHistoryUrl() );

        $params = $api->getHistoryQuery();
        $this->assertContains( 'fields=name,credentials', $params );
        $this->assertContains( 'include_fields=true', $params );
    }
}
