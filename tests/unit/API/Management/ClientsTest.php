<?php

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\API\Management;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

/**
 * Class ClientsTest
 *
 * @package Auth0\Tests\unit\API\Management
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
     * @throws \Exception
     */
    public function testThatBasicGetAllRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->clients()->getAll();

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/clients', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * @throws \Exception
     */
    public function testThatGetAllRequestWithParamsIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->clients()->getAll( [ 'field1', 'field2' ], false, 1, 5, [ 'include_totals' => true ] );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/clients', $api->getHistoryUrl() );

        $query = '&'.$api->getHistoryQuery();
        $this->assertContains( '&fields=field1,field2', $query );
        $this->assertContains( '&include_fields=false', $query );
        $this->assertContains( '&page=1', $query );
        $this->assertContains( '&per_page=5', $query );
        $this->assertContains( '&include_totals=true', $query );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * @throws \Exception
     */
    public function testThatGetRequestWithParamsIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->clients()->get( '__test_id__', [ 'field3', 'field4' ], true );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/clients/__test_id__', $api->getHistoryUrl() );

        $query = '&'.$api->getHistoryQuery();
        $this->assertContains( '&fields=field3,field4', $query );
        $this->assertContains( '&include_fields=true', $query );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * @throws \Exception
     */
    public function testThatDeleteRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->clients()->delete( '__test_id__' );

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/clients/__test_id__', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * @throws \Exception
     */
    public function testThatCreateRequestThrowsExceptionIfNameKeyIsMissing()
    {
        $api = new Management( uniqid(), uniqid() );

        try {
            $api->clients()->create( [ 'app_type' => '__test_app_type__' ] );
            $exception_message = 'No exception caught';
        } catch (\Exception $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertStringStartsWith( 'Missing required "name" field', $exception_message );
    }

    /**
     * @throws \Exception
     */
    public function testThatCreateRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->clients()->create( [ 'name' => '__test_name__', 'app_type' => '__test_app_type__' ] );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/clients', $api->getHistoryUrl() );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'name', $body );
        $this->assertEquals( '__test_name__', $body['name'] );
        $this->assertArrayHasKey( 'app_type', $body );
        $this->assertEquals( '__test_app_type__', $body['app_type'] );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
    }

    /**
     * @throws \Exception
     */
    public function testThatUpdateRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->clients()->update( '__test_id__', [ 'name' => '__test_new_name__' ] );

        $this->assertEquals( 'PATCH', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/clients/__test_id__', $api->getHistoryUrl() );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'name', $body );
        $this->assertEquals( '__test_new_name__', $body['name'] );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
    }

}
