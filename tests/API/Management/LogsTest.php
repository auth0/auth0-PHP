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
     * Valid Log ID to test getter.
     *
     * @var string
     */
    protected static $log_id;

    /**
     * Sets up API client for entire testing class.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        $env   = self::getEnvStatic();
        $token = self::getTokenStatic($env, [ 'logs' => [ 'actions' => ['read'] ] ]);
        $api   = new Management($token, $env['DOMAIN']);

        self::$api = $api->logs;
    }

    /**
     * Test a general search.
     *
     * @return void
     */
    public function testLogSearch()
    {
        $search_results = self::$api->search();
        $this->assertNotEmpty($search_results);

        // Get the 10th log entry to test pagination in self::testLogSearchPagination().
        self::$log_id = $search_results[9]['log_id'];
        $this->assertNotEmpty(self::$log_id);
    }

    /**
     * Test fields parameter.
     *
     * @return void
     */
    public function testLogSearchFields()
    {
        $search_results = self::$api->search([
            'fields' => '_id,log_id,date',
            'include_fields' => true,
        ]);
        $this->assertNotEmpty($search_results);
        $this->assertNotEmpty($search_results[0]['date']);
        $this->assertNotEmpty($search_results[0]['log_id']);
        $this->assertCount(3, $search_results[0]);
    }

    /**
     * Test pagination parameters.
     *
     * @return void
     */
    public function testLogSearchPagination()
    {
        $expected_count = 10;
        $search_results = self::$api->search([
            // Fields here to speed up API call.
            'fields' => '_id,log_id,date',
            'include_fields' => true,

            // First page of 10 results.
            'page' => 0,
            'per_page' => $expected_count,
        ]);
        $this->assertNotEmpty($search_results);
        $this->assertCount($expected_count, $search_results);
    }

    /**
     * Test getting a single log entry with an ID.
     *
     * @return void
     */
    public function testGetOne()
    {
        $one_log = self::$api->get(self::$log_id);
        $this->assertNotEmpty($one_log);
        $this->assertEquals(self::$log_id, $one_log['log_id']);
    }
}
