<?php

namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\API\Management;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

/**
 * Class ClientsTest
 *
 * @package Auth0\Tests\API\Management
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

    public function testThatMethodAndPropertyReturnSameClass()
    {
        $api = new Management(uniqid(), uniqid());
        $this->assertInstanceOf( Management\Clients::class, $api->clients );
        $this->assertInstanceOf( Management\Clients::class, $api->clients() );
        $api->clients = null;
        $this->assertInstanceOf( Management\Clients::class, $api->clients() );
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

    /**
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Exception
     */
    public function testIntegrationCreateGetUpdateDelete()
    {
        $env = self::getEnv();

        if (! $env['API_TOKEN']) {
            $this->markTestSkipped( 'No client secret; integration test skipped' );
        }

        $api = new Management($env['API_TOKEN'], $env['DOMAIN']);

        $unique_id   = uniqid();
        $create_body = [
            'name' => 'TEST-CREATE-CLIENT-'.$unique_id,
            'app_type' => 'regular_web',
        ];

        $created_client = $api->clients()->create($create_body);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        $this->assertNotEmpty($created_client['client_id']);
        $this->assertEquals($create_body['name'], $created_client['name']);
        $this->assertEquals($create_body['app_type'], $created_client['app_type']);

        $created_client_id = $created_client['client_id'];
        $got_entity        = $api->clients()->get($created_client_id);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        // Make sure what we got matches what we created.
        $this->assertEquals($created_client_id, $got_entity['client_id']);

        $update_body = [
            'name' => 'TEST-UPDATE-CLIENT-'.$unique_id,
            'app_type' => 'native',
        ];

        $updated_client = $api->clients()->update($created_client_id, $update_body );
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        $this->assertEquals($created_client_id, $updated_client['client_id']);
        $this->assertEquals($update_body['name'], $updated_client['name']);
        $this->assertEquals($update_body['app_type'], $updated_client['app_type']);

        $api->clients()->delete($created_client_id);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    }

    /**
     * @throws \Exception
     */
    public function testIntegrationGetAllMethod()
    {
        $env = self::getEnv();

        if (! $env['API_TOKEN']) {
            $this->markTestSkipped( 'No client secret; integration test skipped' );
        }

        $api      = new Management($env['API_TOKEN'], $env['DOMAIN']);
        $fields   = ['client_id', 'tenant', 'name', 'app_type'];
        $page_num = 3;

        // Get the second page of Clients with 1 per page (second result).
        $paged_results = $api->clients()->getAll($fields, true, $page_num, 1);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        // Make sure we only have one result, as requested.
        $this->assertEquals(1, count($paged_results));

        // Make sure we only have the 6 fields we requested.
        $this->assertEquals(count($fields), count($paged_results[0]));

        // Get many results (needs to include the created result if self::findCreatedItem === true).
        $many_results_per_page = 50;
        $many_results          = $api->clients()->getAll($fields, true, 0, $many_results_per_page);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);

        // Make sure we have at least as many results as we requested.
        $this->assertLessThanOrEqual($many_results_per_page, count($many_results));

        // Make sure our paged result above appears in the right place.
        // $page_num here represents the expected location for the single entity retrieved above.
        $this->assertEquals($paged_results[0]['client_id'], $many_results[$page_num]['client_id']);
    }
}
