<?php
namespace Auth0\Tests\API\Management;

use Auth0\Tests\MockApi;
use Auth0\Tests\Traits\ErrorHelpers;
use Auth0\Tests\MockJsonBody;
use GuzzleHttp\Psr7\Response;

/**
 * Class ConnectionsTestMocked.
 *
 * @package Auth0\Tests\API\Management
 */
class ConnectionsTestMocked extends \PHPUnit_Framework_TestCase
{

    use ErrorHelpers;

    const ENDPOINT = 'connections';

    /**
     * Instance of MockJsonBody.
     *
     * @var MockJsonBody
     */
    protected static $mockJson;

    /**
     * Run before the test suite starts.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$mockJson = new MockJsonBody( self::ENDPOINT );
    }

    /**
     * Test a basic getAll connection call.
     *
     * @return void
     */
    public function testConnectionsGetAll()
    {
        $api = new MockApi( self::ENDPOINT, [
            new Response( 200, [], self::$mockJson->getClean() ),
        ] );

        $response = $api->call()->getAll();
        $this->assertCount( 10, json_decode($response->getBody()) );

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertEquals( 'https://'.$api::API_DOMAIN.'/api/v2/'.self::ENDPOINT, $api->getHistoryUrl() );
    }


    /**
     * Test a getAll request filtered by strategy.
     *
     * @return void
     */
    public function testThatConnectionsGetAllAddsFilters()
    {
        $strategy = 'test-strategy-01';
        $api      = new MockApi( self::ENDPOINT, [
            new Response( 200, [], self::$mockJson->withFilter( 'strategy', $strategy )->getClean() ),
        ] );

        $response      = $api->call()->getAll($strategy);
        $response_body = json_decode($response->getBody(), true);

        $this->assertCount( 3, $response_body );
        foreach ($response_body as $datum) {
            $this->assertEquals( $strategy, $datum['strategy'] );
        }

        $this->assertContains( 'strategy='.$strategy, $api->getHistoryQuery() );
    }

    /**
     * Test a getAll request with included fields.
     *
     * @return void
     */
    public function testThatConnectionsGetAllIncludesFields()
    {
        $fields = ['id', 'name'];
        $api    = new MockApi( self::ENDPOINT, [
            new Response( 200, [], self::$mockJson->withFields( $fields )->getClean() ),
            new Response( 200, [], self::$mockJson->withFields( $fields )->getClean() ),
        ] );

        $response      = $api->call()->getAll(null, $fields);
        $response_body = json_decode($response->getBody(), true);

        $this->assertCount( 10, $response_body );
        foreach ($response_body as $datum) {
            foreach ($fields as $field) {
                $this->assertTrue( isset( $datum[$field] ) );
            }
        }

        $this->assertContains( 'fields='.implode(',', $fields), $api->getHistoryQuery() );

        // Test an explicit true for includeFields.
        $api->call()->getAll(null, $fields, true);
        $this->assertContains( 'include_fields=true', $api->getHistoryQuery(1) );
    }

    /**
     * Test a getAll request with excluded fields.
     *
     * @return void
     */
    public function testThatConnectionsGetAllExcludesFields()
    {
        $fields = ['id', 'name'];
        $api    = new MockApi( self::ENDPOINT, [
            new Response( 200, [], self::$mockJson->withFields( $fields, false )->getClean() ),
        ] );

        $response      = $api->call()->getAll(null, $fields, false);
        $response_body = json_decode($response->getBody(), true);

        $this->assertCount( 10, $response_body );
        foreach ($response_body as $datum) {
            foreach ($fields as $field) {
                $this->assertFalse( isset( $datum[$field] ) );
            }
        }

        $this->assertContains( 'fields='.implode(',', $fields), $api->getHistoryQuery() );
        $this->assertContains( 'include_fields=false', $api->getHistoryQuery() );
    }

    /**
     * Test a paginated getAll request.
     *
     * @return void
     */
    public function testThatConnectionsGetAllPaginates()
    {
        $api = new MockApi( self::ENDPOINT, [
            new Response( 200, [], self::$mockJson->withPages( 0, 5 )->getClean() ),
            new Response( 200, [], self::$mockJson->withPages( 1, 4 )->getClean() ),
        ] );

        $response1      = $api->call()->getAll(null, null, null, 0, 5);
        $response1_body = json_decode($response1->getBody(), true);

        $this->assertContains( 'page=0', $api->getHistoryQuery() );
        $this->assertContains( 'per_page=5', $api->getHistoryQuery() );
        $this->assertCount( 5, $response1_body );

        $response2      = $api->call()->getAll(null, null, null, 1, 4);
        $response2_body = json_decode($response2->getBody(), true);

        $this->assertCount( 4, $response2_body );
        $this->assertEquals( $response1_body[4], $response2_body[0] );
        $this->assertContains( 'page=1', $api->getHistoryQuery(1) );
        $this->assertContains( 'per_page=4', $api->getHistoryQuery(1) );
    }

    /**
     * Test a getAll request with additional parameters added.
     *
     * @return void
     */
    public function testThatConnectionsGetAllAddsExtraParams()
    {
        $params = ['param1' => 'value1', 'param2' => 'value2'];
        $api    = new MockApi( self::ENDPOINT, [
            new Response( 200, [], self::$mockJson->getClean() ),
        ] );

        $api->call()->getAll(null, null, null, null, null, $params);
        $this->assertContains( 'param1=value1', $api->getHistoryQuery() );
        $this->assertContains( 'param2=value2', $api->getHistoryQuery() );
    }

    /**
     * Test a basic get request.
     *
     * @return void
     */
    public function testConnectionsGet()
    {
        $id  = 'con_testConnection10';
        $api = new MockApi( self::ENDPOINT, [
            new Response( 200, [], self::$mockJson->withFilter( 'id', $id )->getClean( true ) ),
        ] );

        $response      = $api->call()->get($id);
        $response_body = json_decode($response->getBody());

        $this->assertObjectHasAttribute( 'id', $response_body );
        $this->assertEquals( $id, $response_body->id );
        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://'.$api::API_DOMAIN.'/api/v2/'.self::ENDPOINT.'/'.$id,
            $api->getHistoryUrl()
        );
    }

    /**
     * Test a get call with included fields.
     *
     * @return void
     */
    public function testThatConnectionsGetIncludesFields()
    {
        $id       = 'con_testConnection10';
        $fields   = ['name', 'strategy'];
        $jsonBody = self::$mockJson->withFilter( 'id', $id )->withFields( $fields )->getClean( true );
        $api      = new MockApi( self::ENDPOINT, [
            new Response( 200, [], $jsonBody ),
        ] );

        $response      = $api->call()->get($id, $fields);
        $response_body = json_decode($response->getBody());

        foreach ($fields as $field) {
            $this->assertObjectHasAttribute( $field, $response_body );
        }

        $this->assertContains( 'fields='.implode(',', $fields), $api->getHistoryQuery() );
    }

    /**
     * Test a get call with excluded fields.
     *
     * @return void
     */
    public function testThatConnectionsGetExcludesFields()
    {
        $id       = 'con_testConnection10';
        $fields   = ['name', 'strategy'];
        $jsonBody = self::$mockJson->withFilter( 'id', $id )->withFields( $fields, false )->getClean( true );
        $api      = new MockApi( self::ENDPOINT, [
            new Response( 200, [], $jsonBody ),
        ] );

        $response      = $api->call()->get($id, $fields, false);
        $response_body = json_decode($response->getBody());

        foreach ($fields as $field) {
            $this->assertObjectNotHasAttribute( $field, $response_body );
        }

        $this->assertContains( 'fields='.implode(',', $fields), $api->getHistoryQuery() );
        $this->assertContains( 'include_fields=false', $api->getHistoryQuery() );
    }

    /**
     * Test a basic delete connection request.
     *
     * @return void
     */
    public function testConnectionsDelete()
    {
        $id  = 'con_testConnection10';
        $api = new MockApi( self::ENDPOINT, [
            new Response( 204, [] ),
        ] );

        $api->call()->delete($id);

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://'.$api::API_DOMAIN.'/api/v2/'.self::ENDPOINT.'/'.$id,
            $api->getHistoryUrl()
        );
    }

    /**
     * Test a delete user for connection request.
     *
     * @return void
     */
    public function testConnectionsDeleteUser()
    {
        $id    = 'con_testConnection10';
        $email = 'con_testConnection10@auth0.com';
        $api   = new MockApi( self::ENDPOINT, [
            new Response( 204, [] ),
        ] );

        $api->call()->deleteUser($id, $email);

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals( 'https', $api->getHistoryUrl( 0, PHP_URL_SCHEME ) );
        $this->assertEquals( $api::API_DOMAIN, $api->getHistoryUrl( 0, PHP_URL_HOST ) );
        $this->assertEquals(
            '/api/v2/'.self::ENDPOINT.'/'.$id.'/users',
            $api->getHistoryUrl( 0, PHP_URL_PATH )
        );
        $this->assertContains( 'email='.$email, $api->getHistoryQuery() );
    }

    /**
     * Test a basic connection create call.
     *
     * @return void
     */
    public function testConnectionsCreate()
    {
        $name     = 'TestConnection01';
        $strategy = 'test-strategy-01';
        $api      = new MockApi( self::ENDPOINT, [
            new Response( 200, [], self::$mockJson->getClean( true ) ),
        ] );

        $response      = $api->call()->create( [ 'name' => $name, 'strategy' => $strategy ] );
        $response_body = json_decode($response->getBody(), true);
        $request_body  = $api->getHistoryBody();

        $this->assertEquals( $name, $response_body['name'] );
        $this->assertEquals( $strategy, $response_body['strategy'] );
        $this->assertArrayHasKey( 'id', $response_body );

        $this->assertEquals( $name, $request_body['name'] );
        $this->assertEquals( $strategy, $request_body['strategy'] );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://'.$api::API_DOMAIN.'/api/v2/'.self::ENDPOINT, $api->getHistoryUrl() );
    }


    /**
     * Test a connection create call exceptions.
     *
     * @return void
     */
    public function testThatConnectionsCreateThrowsExceptions()
    {
        $name     = 'TestConnection01';
        $strategy = 'test-strategy-01';
        $api      = new MockApi( self::ENDPOINT );

        $caught_no_name_exception = false;
        try {
            $api->call()->create(['strategy' => $strategy]);
        } catch (\Exception $e) {
            $caught_no_name_exception = $this->errorHasString($e, 'Missing required "name" field');
        }

        $this->assertTrue($caught_no_name_exception);

        $caught_no_strategy_exception = false;
        try {
            $api->call()->create(['name' => $name]);
        } catch (\Exception $e) {
            $caught_no_strategy_exception = $this->errorHasString($e, 'Missing required "strategy" field');
        }

        $this->assertTrue($caught_no_strategy_exception);
    }

    /**
     * Test a basic update request.
     *
     * @return void
     */
    public function testConnectionsUpdate()
    {
        $id          = 'con_testConnection10';
        $update_data = [ 'metadata' => [ 'meta1' => 'value1' ] ];
        $api         = new MockApi( self::ENDPOINT, [
            new Response( 200, [], self::$mockJson->withFilter( 'id', $id )->getClean( true ) ),
        ] );

        $response      = $api->call()->update($id, $update_data);
        $response_body = json_decode($response->getBody(), true);
        $request_body  = $api->getHistoryBody();

        $this->assertEquals( $id, $response_body['id'] );
        $this->assertEquals( $update_data['metadata'], $response_body['metadata'] );
        $this->assertEquals( $update_data, $request_body );

        $this->assertEquals( 'PATCH', $api->getHistoryMethod() );
        $this->assertEquals(
            'https://'.$api::API_DOMAIN.'/api/v2/'.self::ENDPOINT.'/'.$id,
            $api->getHistoryUrl()
        );
    }
}
