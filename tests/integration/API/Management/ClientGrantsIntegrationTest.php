<?php

namespace Auth0\Tests\integration\API\Management;

use Auth0\SDK\API\Management;
use Auth0\SDK\Exception\CoreException;
use Auth0\Tests\API\ApiTests;

/**
 * Class ClientGrantsIntegrationTest.
 * Tests the Auth0\SDK\API\Management\ClientGrants class.
 *
 * @package Auth0\Tests\integration\API\Management
 */
class ClientGrantsIntegrationTest extends ApiTests
{

    /**
     * Client Grants API client.
     *
     * @var Management\ClientGrants
     */
    protected static $api;

    /**
     * Resource Server identifier.
     *
     * @var string
     */
    protected static $apiIdentifier;

    /**
     * Valid test scopes for the "tests" API.
     * Used for testing create and update.
     *
     * @var array
     */
    protected static $scopes = ['test:scope1', 'test:scope2'];

    /**
     * @throws CoreException
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Exception
     */
    public static function setUpBeforeClass()
    {
        self::getEnv();
        $api       = new Management(self::$env['API_TOKEN'], self::$env['DOMAIN']);
        self::$api = $api->clientGrants();

        $create_data = [
            'name' => 'TEST_PHP_SDK_CREATE_'.uniqid(),
            'token_lifetime' => rand( 10000, 20000 ),
            'signing_alg' => 'RS256'
        ];

        self::$apiIdentifier = 'TEST_PHP_SDK_CLIENT_GRANT_API_'.uniqid();
        $api->resourceServers()->create(self::$apiIdentifier, $create_data);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    }

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @throws CoreException
     * @throws \Exception
     */
    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();
        $api = new Management(self::$env['API_TOKEN'], self::$env['DOMAIN']);
        $api->resourceServers()->delete( self::$apiIdentifier );
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    }

    /**
     * Test that get methods work as expected.
     *
     * @return void
     *
     * @throws CoreException Thrown when there is a problem with parameters passed to the method.
     * @throws \Exception Thrown by the Guzzle HTTP client when there is a problem with the API call.
     */
    public function testGet()
    {
        $all_results = self::$api->getAll();
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertNotEmpty($all_results);

        $expected_client_id = $all_results[0]['client_id'] ?: null;
        $this->assertNotNull($expected_client_id);

        $expected_audience = $all_results[0]['audience'] ?: null;
        $this->assertNotNull($expected_audience);

        $audience_results = self::$api->getByAudience($expected_audience);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertNotEmpty($audience_results);
        $this->assertEquals($expected_audience, $audience_results[0]['audience']);

        $client_id_results = self::$api->getByClientId($expected_client_id);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertNotEmpty($client_id_results);
        $this->assertEquals($expected_client_id, $client_id_results[0]['client_id']);
    }

    /**
     * Test that pagination parameters are passed to the endpoint.
     *
     * @return void
     *
     * @throws \Exception Thrown by the Guzzle HTTP client when there is a problem with the API call.
     */
    public function testGetWithPagination()
    {
        $expected_count = 2;

        $results_1 = self::$api->getAll([], 0, $expected_count);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertCount($expected_count, $results_1);

        $expected_page = 1;
        $results_2     = self::$api->getAll([], $expected_page, 1);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertCount(1, $results_2);
        $this->assertEquals($results_1[$expected_page]['client_id'], $results_2[0]['client_id']);
        $this->assertEquals($results_1[$expected_page]['audience'], $results_2[0]['audience']);
    }

    /**
     * Test that the "include_totals" parameter works.
     *
     * @return void
     *
     * @throws \Exception Thrown by the Guzzle HTTP client when there is a problem with the API call.
     */
    public function testGetAllIncludeTotals()
    {
        $expected_page  = 0;
        $expected_count = 2;

        $results = self::$api->getAll(['include_totals' => true], $expected_page, $expected_count);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertArrayHasKey('total', $results);
        $this->assertEquals($expected_page * $expected_count, $results['start']);
        $this->assertEquals($expected_count, $results['limit']);
        $this->assertNotEmpty($results['client_grants']);
    }

    /**
     * Test that we can create, update, and delete a Client Grant.
     *
     * @return void
     *
     * @throws CoreException Thrown when there is a problem with parameters passed to the method.
     * @throws \Exception Thrown by the Guzzle HTTP client when there is a problem with the API call.
     */
    public function testCreateUpdateDeleteGrant()
    {
        $client_id = self::$env['APP_CLIENT_ID'];
        $audience  = self::$apiIdentifier;

        // Create a Client Grant with just one of the testing scopes.
        $create_result = self::$api->create($client_id, $audience, [self::$scopes[0]]);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertArrayHasKey('id', $create_result);
        $this->assertEquals($client_id, $create_result['client_id']);
        $this->assertEquals($audience, $create_result['audience']);
        $this->assertEquals([self::$scopes[0]], $create_result['scope']);

        $grant_id = $create_result['id'];

        // Test patching the created Client Grant.
        $update_result = self::$api->update($grant_id, self::$scopes);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertEquals(self::$scopes, $update_result['scope']);

        // Test deleting the created Client Grant.
        $delete_result = self::$api->delete($grant_id);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertNull($delete_result);
    }

    /**
     * Test that create method throws errors correctly.
     *
     * @return void
     *
     * @throws \Exception Thrown by the Guzzle HTTP client when there is a problem with the API call.
     */
    public function testCreateGrantExceptions()
    {
        $throws_missing_client_id_exception = false;
        try {
            self::$api->create('', self::$apiIdentifier, []);
        } catch (CoreException $e) {
            $throws_missing_client_id_exception = $this->errorHasString($e, 'Empty or invalid "client_id" parameter');
        }

        $this->assertTrue($throws_missing_client_id_exception);

        $throws_missing_audience_exception = false;
        try {
            self::$api->create(self::$env['APP_CLIENT_ID'], '', []);
        } catch (CoreException $e) {
            $throws_missing_audience_exception = $this->errorHasString($e, 'Empty or invalid "audience" parameter');
        }

        $this->assertTrue($throws_missing_audience_exception);
    }
}
