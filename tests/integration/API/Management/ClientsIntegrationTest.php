<?php

namespace Auth0\Tests\integration\API\Management;

use Auth0\SDK\API\Management;
use Auth0\Tests\API\ApiTests;

/**
 * Class ClientsTest
 *
 * @package Auth0\Tests\integration\API\Management
 */
class ClientsIntegrationTest extends ApiTests
{

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
