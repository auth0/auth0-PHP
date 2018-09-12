<?php
namespace Auth0\Tests\API\Management;

use Auth0\Tests\API\ApiTests;

use GuzzleHttp\Psr7\Response;

/**
 * Class ConnectionsTest.
 *
 * @package Auth0\Tests\API\Management
 */
class ConnectionsTest extends ApiTests
{
    /**
     * Set static vars for this test suite.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::$endpoint = 'connections';
    }

    /**
     * Test a basic getAll request.
     *
     * @return void
     */
    public function testGetAll()
    {
        $api = self::getMockApi( [
            new Response( 200, [], json_encode(self::getJson()) ),
        ] );

        $response = $api->getAll();
        $request  = self::getMockRequestHistory();

        // Only need to test the HTTP method and headers once per method.
        $this->assertEquals( 'GET', $request->getMethod() );
        $this->assertHeaders( $request->getHeaders() );

        $this->assertUri( $request );

        $response_body = json_decode($response->getBody(), true);
        $this->assertCount( 20, $response_body );
    }

    /**
     * Test a getAll request filtered by strategy.
     *
     * @return void
     */
    public function testGetAllWithStrategy()
    {
        $filter_key = 'strategy';
        $filter_val = 'test-strategy-01';
        $api        = self::getMockApi( [
            new Response( 200, [], json_encode(self::getJson( [$filter_key => $filter_val] )) ),
        ] );

        $response = $api->getAll($filter_val);
        $request  = self::getMockRequestHistory();

        $this->assertUri( $request, '?'.$filter_key.'='.$filter_val );

        $response_body = json_decode($response->getBody(), true);
        $this->assertCount( 6, $response_body );
        foreach ($response_body as $datum) {
            $this->assertEquals( $filter_val, $datum[$filter_key] );
        }
    }

    /**
     * Test a getAll request with included fields.
     *
     * @return void
     */
    public function testGetAllWithIncludedFields()
    {
        $fields = ['id', 'name'];
        $api    = self::getMockApi( [
            new Response( 200, [], json_encode(self::getJson( [], [], [$fields, true] )) ),
            new Response( 200, [], json_encode(self::getJson( [], [], [$fields, true] )) ),
        ] );

        // Test the default of null for includeFields.
        $response = $api->getAll(null, $fields);
        $request  = self::getMockRequestHistory();

        $this->assertUri( $request, '?fields='.implode( ',', $fields ) );

        $response_body = json_decode($response->getBody(), true);
        $this->assertCount( 20, $response_body );
        foreach ($response_body as $datum) {
            foreach ($fields as $field) {
                $this->assertTrue( isset( $datum[$field] ) );
            }
        }

        // Test an explicit true for includeFields.
        $api->getAll(null, $fields, true);
        $request = self::getMockRequestHistory(1);

        $this->assertUri( $request, '?fields='.implode( ',', $fields ).'&include_fields=true' );
    }

    /**
     * Test a getAll request with excluded fields.
     *
     * @return void
     */
    public function testGetAllWithExcludedFields()
    {
        $fields = ['id', 'name'];
        $api    = self::getMockApi( [
            new Response( 200, [], json_encode(self::getJson( [], [], [$fields, false] ))),
        ] );

        $response = $api->getAll(null, $fields, false);
        $request  = self::getMockRequestHistory();

        $this->assertUri( $request, '?fields='.implode( ',', $fields ).'&include_fields=false' );

        $response_body = json_decode($response->getBody(), true);
        $this->assertCount( 20, $response_body );
        foreach ($response_body as $datum) {
            foreach ($fields as $field) {
                $this->assertFalse( isset( $datum[$field] ) );
            }
        }
    }

    /**
     * Test a pagination getAll request.
     *
     * @return void
     */
    public function testGetAllWithPagination()
    {
        $paged_1 = [0, 10];
        $paged_2 = [1, 9];
        $api     = self::getMockApi( [
            new Response( 200, [], json_encode(self::getJson( [], $paged_1 )) ),
            new Response( 200, [], json_encode(self::getJson( [], $paged_2 )) ),
        ] );

        $response_1 = $api->getAll(null, null, null, $paged_1[0], $paged_1[1]);
        $request_1  = self::getMockRequestHistory();

        $this->assertUri( $request_1, '?page='.$paged_1[0].'&per_page='.$paged_1[1] );

        $response_body_1 = json_decode($response_1->getBody(), true);
        $this->assertCount( 10, $response_body_1 );

        $response_2 = $api->getAll(null, null, null, $paged_2[0], $paged_2[1]);
        $request_2  = self::getMockRequestHistory(1);

        $this->assertUri( $request_2, '?page='.$paged_2[0].'&per_page='.$paged_2[1] );

        $response_body_2 = json_decode($response_2->getBody(), true);
        $this->assertCount( 9, $response_body_2 );
        $this->assertEquals( $response_body_1[9], $response_body_2[0] );
    }

    /**
     * Test a getAll request with additional parameters added.
     *
     * @return void
     */
    public function testGetAllWithAdditionalParams()
    {
        $params = [
            'param1' => 'value1',
            'param2' => 'value2',
        ];
        $api    = self::getMockApi( [
            new Response( 200, [], json_encode(self::getJson()) ),
        ] );

        $api->getAll(null, null, null, null, null, $params);
        $request = self::getMockRequestHistory();

        $param_keys = array_keys($params);
        $this->assertUri(
            $request,
            '?'.$param_keys[0].'='.$params[$param_keys[0]].'&'.$param_keys[1].'='.$params[$param_keys[1]]
        );
    }

    /**
     * Test a basic get request.
     *
     * @return void
     */
    public function testGet()
    {
        $id     = 'con_testConnection10';
        $fields = ['name', 'strategy'];
        $api    = self::getMockApi( [
            new Response( 200, [], json_encode(self::getJson( ['id' => $id] )) ),
            new Response( 200, [], json_encode(self::getJson( ['id' => $id], [], [$fields, true] )) ),
            new Response( 200, [], json_encode(self::getJson( ['id' => $id], [], [$fields, false] )) ),
        ] );

        $response_1 = $api->get($id);
        $request_1  = self::getMockRequestHistory();

        $this->assertUri( $request_1, '/'.$id );
        $this->assertHeaders( $request_1->getHeaders() );
        $this->assertEquals( 'GET', $request_1->getMethod() );

        $response_body_1 = json_decode($response_1->getBody(), true);
        $this->assertCount( 1, $response_body_1 );
        $this->assertEquals( $id, $response_body_1[0]['id'] );

        // Test get with fields included.
        $response_2 = $api->get($id, $fields);
        $request_2  = self::getMockRequestHistory(1);

        $this->assertUri( $request_2, '/'.$id.'?fields='.implode( ',', $fields ) );

        $response_body_2 = json_decode($response_2->getBody(), true);
        $this->assertCount( 1, $response_body_2 );
        foreach ($response_body_2 as $datum) {
            foreach ($fields as $field) {
                $this->assertTrue( isset( $datum[$field] ) );
            }
        }

        $response_3 = $api->get($id, $fields, false);
        $request_3  = self::getMockRequestHistory(2);

        $this->assertUri( $request_3, '/'.$id.'?fields='.implode( ',', $fields ).'&include_fields=false' );

        $response_body_3 = json_decode($response_3->getBody(), true);
        $this->assertCount( 1, $response_body_3 );
        foreach ($response_body_3 as $datum) {
            foreach ($fields as $field) {
                $this->assertFalse( isset( $datum[$field] ) );
            }
        }
    }

    /**
     * Test a basic delete request.
     *
     * @return void
     */
    public function testDelete()
    {
        $id  = 'con_testConnection10';
        $api = self::getMockApi( [
            new Response( 204, [] ),
        ] );

        $api->delete($id);
        $request = self::getMockRequestHistory();

        $this->assertUri( $request, '/'.$id );
        $this->assertHeaders( $request->getHeaders() );
        $this->assertEquals( 'DELETE', $request->getMethod() );
    }

    /**
     * Test a deleteUser request.
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $id    = 'con_testConnection10';
        $email = 'con_testConnection10@auth0.com';
        $api   = self::getMockApi( [
            new Response( 204, [] ),
        ] );

        $api->deleteUser($id, $email);
        $request = self::getMockRequestHistory();

        $this->assertUri( $request, '/'.$id.'/users?email='.$email );
        $this->assertHeaders( $request->getHeaders() );
        $this->assertEquals( 'DELETE', $request->getMethod() );
    }

    /**
     * Test a basic create request.
     *
     * @return void
     */
    public function testCreate()
    {
        $name     = 'TestConnection01';
        $strategy = 'test-strategy-01';
        $api      = self::getMockApi( [
            new Response( 200, [], json_encode(self::getJson([], [0, 1])[0]) ),
        ] );

        $response = $api->create([
            'name' => $name,
            'strategy' => $strategy,
        ]);
        $request  = self::getMockRequestHistory();

        $this->assertUri( $request );
        $this->assertHeaders( $request->getHeaders() );
        $this->assertEquals( 'POST', $request->getMethod() );

        $request_body = json_decode($request->getBody(), true);
        $this->assertEquals( $name, $request_body['name'] );
        $this->assertEquals( $strategy, $request_body['strategy'] );

        $response_body = json_decode($response->getBody(), true);
        $this->assertEquals( $name, $response_body['name'] );
        $this->assertEquals( $strategy, $response_body['strategy'] );
    }

    /**
     * Test a basic create request.
     *
     * @return void
     */
    public function testCreateExceptions()
    {
        $name     = 'TestConnection01';
        $strategy = 'test-strategy-01';
        $api      = self::getMockApi([]);

        $caught_no_name_exception = false;
        try {
            $api->create(['strategy' => $strategy]);
        } catch (\Exception $e) {
            $caught_no_name_exception = $this->errorHasString($e, 'Missing required "name" field');
        }

        $this->assertTrue($caught_no_name_exception);

        $caught_no_strategy_exception = false;
        try {
            $api->create(['name' => $name]);
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
    public function testUpdate()
    {
        $id       = 'con_testConnection20';
        $metadata = [ [ 'meta1' => 'value1' ] ];
        $api      = self::getMockApi( [
            new Response( 200, [], json_encode( self::getJson(['id' => $id])[0] ) ),
        ] );

        $response = $api->update($id, $metadata);
        $request  = self::getMockRequestHistory();

        $this->assertUri( $request, '/'.$id );
        $this->assertHeaders( $request->getHeaders() );
        $this->assertEquals( 'PATCH', $request->getMethod() );

        $request_body = json_decode($request->getBody(), true);
        $this->assertEquals( $metadata, $request_body );

        $response_body = json_decode($response->getBody(), true);
        $this->assertEquals( $id, $response_body['id'] );
        $this->assertEquals( $metadata[0], $response_body['metadata'] );
    }
}
