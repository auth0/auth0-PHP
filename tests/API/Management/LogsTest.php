<?php

namespace Auth0\Tests\API;

use Auth0\SDK\API\Management;

/**
 * Class LogsTest.
 * Tests the Auth0\SDK\API\Management\Logs class.
 *
 * @package Auth0\Tests\API
 */
class LogsTest extends ApiTests
{

    /**
     * Logs API client.
     *
     * @var mixed
     */
    protected static $api;

    /**
     * Sets up API client for entire testing class.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        $env   = self::getEnvStatic();
        $token = self::getTokenStatic($env, [ 'logs' => [ 'actions' => ['read'] ] ]);
        $api   = new Management($token, $env['DOMAIN'], ['timeout' => 30]);

        self::$api = $api->logs;
    }

    /**
     * Test a general search.
     *
     * @return void
     */
    public function testLogSearchAndGetById()
    {
        $search_results = self::$api->search([
            'fields' => '_id,log_id,date',
            'include_fields' => true,
        ]);
        $this->assertNotEmpty($search_results);
        $this->assertNotEmpty($search_results[0]['_id']);
        $this->assertNotEmpty($search_results[0]['log_id']);
        $this->assertNotEmpty($search_results[0]['date']);
        $this->assertCount(3, $search_results[0]);

        // Test getting a single log result with a valid ID from above.
        $one_log = self::$api->get($search_results[0]['log_id']);
        $this->assertNotEmpty($one_log);
        $this->assertEquals($search_results[0]['log_id'], $one_log['log_id']);
    }

    /**
     * Test pagination parameters.
     *
     * @return void
     */
    public function testLogSearchPagination()
    {
        $search_params  = [
            // Fields here to speed up API call.
            'fields' => '_id,log_id',
            'include_fields' => true,

            // First page of 2 results.
            'page' => 0,
            'per_page' => 2,
        ];

        // Get one page of 2 results and check the count.
        $search_results_1 = self::$api->search($search_params);
        $this->assertCount(2, $search_results_1);

        // Now get one page of a single result and make sure it matches the second result above.
        $search_params['page']     = 1;
        $search_params['per_page'] = 1;
        $search_results_2          = self::$api->search($search_params);
        $this->assertCount(1, $search_results_2);
        $this->assertEquals($search_results_1[1]['log_id'], $search_results_2[0]['log_id']);
    }
}
