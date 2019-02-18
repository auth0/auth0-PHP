<?php
namespace Auth0\Tests\API\Management;

use Auth0\Tests\MockApi;
use Auth0\Tests\Traits\ErrorHelpers;

use Auth0\SDK\API\Helpers\InformationHeaders;

use GuzzleHttp\Psr7\Response;

/**
 * Class GrantsTestMocked.
 *
 * @package Auth0\Tests\API\Management
 */
class GrantsTestMocked extends \PHPUnit_Framework_TestCase
{

    use ErrorHelpers;

    /**
     * Expected telemetry value.
     *
     * @var string
     */
    protected static $telemetry;

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass()
    {
        $infoHeadersData = new InformationHeaders;
        $infoHeadersData->setCorePackage();
        self::$telemetry = $infoHeadersData->build();
    }

    /**
     * Test a basic getAll grant call.
     *
     * @return void
     *
     * @throws \Exception Unsuccessful HTTP call.
     */
    public function testGrantsGetAll()
    {
        $api = new MockApi( [ new Response( 200 ) ] );

        $api->call()->grants->getAll();

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/grants', $api->getHistoryUrl() );
        $this->assertEmpty( $api->getHistoryQuery() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$telemetry, $headers['Auth0-Client'][0] );
    }

    /**
     * Test a paginated getAll request.
     *
     * @return void
     *
     * @throws \Exception Unsuccessful HTTP call.
     */
    public function testThatGrantsGetAllPaginates()
    {
        $api = new MockApi( [ new Response( 200 ), new Response( 200 ), new Response( 200 ) ] );

        $page     = 1;
        $per_page = 5;
        $api->call()->grants->getAll($page, $per_page);

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/grants', $api->getHistoryUrl() );
        $this->assertContains( 'page=1', $api->getHistoryQuery() );
        $this->assertContains( 'per_page=5', $api->getHistoryQuery() );

        $page     = 2;
        $per_page = null;
        $api->call()->grants->getAll($page, $per_page);

        $this->assertContains( 'page=2', $api->getHistoryQuery() );
        $this->assertNotContains( 'per_page=', $api->getHistoryQuery() );

        $page     = false;
        $per_page = false;
        $api->call()->grants->getAll($page, $per_page);

        $this->assertNull( $api->getHistoryQuery() );
    }

    /**
     * Test a getAll request with additional parameters added.
     *
     * @return void
     *
     * @throws \Exception Unsuccessful HTTP call.
     */
    public function testThatGrantsGetAllAddsExtraParams()
    {
        $api = new MockApi( [ new Response( 200 ) ] );

        $add_params = ['param1' => 'value1', 'param2' => 'value2'];
        $api->call()->grants->getAll(null, null, $add_params);

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/grants', $api->getHistoryUrl() );
        $this->assertContains( 'param1=value1', $api->getHistoryQuery() );
        $this->assertContains( 'param2=value2', $api->getHistoryQuery() );
    }

    /**
     * Test a basic delete grant request.
     *
     * @return void
     *
     * @throws \Exception Unsuccessful HTTP call.
     */
    public function testGrantsDelete()
    {
        $api = new MockApi( [ new Response( 204 ) ] );

        $id = uniqid();
        $api->call()->grants->delete($id);

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/grants/'.$id, $api->getHistoryUrl() );
        $this->assertEmpty( $api->getHistoryQuery() );
    }

}
