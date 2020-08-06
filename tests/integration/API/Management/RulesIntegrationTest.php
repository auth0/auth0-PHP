<?php
namespace Auth0\Tests\integration\API\Management;

use Auth0\SDK\API\Management;
use Auth0\SDK\Exception\CoreException;

use Auth0\Tests\API\ApiTests;

/**
 * Class RulesTest.
 *
 * @package Auth0\Tests\integration\API\Management
 */
class RulesIntegrationTest extends ApiTests
{

    /**
     * Rules API client.
     *
     * @var Management\Rules
     */
    protected static $api;

    /**
     * Sets up API client for the testing class.
     *
     * @return void
     *
     * @throws \Auth0\SDK\Exception\ApiException
     */
    public static function setUpBeforeClass()
    {
        self::getEnv();
    }

    /**
     * Test that get methods work as expected.
     *
     * @return void
     *
     * @throws CoreException Thrown when there is a problem with parameters passed to the method.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     */
    public function testGet()
    {
        $api = new Management(self::$env['API_TOKEN'], self::$env['DOMAIN']);

        $results = $api->rules()->getAll();
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertNotEmpty($results);

        // Check getting a single rule by a known ID.
        $get_rule_id = $results[0]['id'];
        $result      = $api->rules()->get($get_rule_id);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertNotEmpty($result);
        $this->assertEquals($results[0]['id'], $get_rule_id);

        // Iterate through the results to see if we have enabled and disabled Rules.
        $has_enabled  = false;
        $has_disabled = false;
        foreach ($results as $result) {
            if ($result['enabled']) {
                $has_enabled = true;
            } else {
                $has_disabled = true;
            }
        }

        // Check enabled rules.
        $enabled_results = $api->rules()->getAll(true);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        if ($has_enabled) {
            $this->assertNotEmpty($enabled_results);
        } else {
            $this->assertEmpty($enabled_results);
        }

        // Check disabled rules.
        $disabled_results = $api->rules()->getAll(false);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        if ($has_disabled) {
            $this->assertNotEmpty($disabled_results);
        } else {
            $this->assertEmpty($disabled_results);
        }
    }

    /**
     * Test that get methods respect fields.
     *
     * @return void
     *
     * @throws CoreException Thrown when there is a problem with parameters passed to the method.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     */
    public function testGetWithFields()
    {
        $api = new Management(self::$env['API_TOKEN'], self::$env['DOMAIN']);

        $fields = ['id', 'name'];

        $fields_results = $api->rules()->getAll(null, $fields, true);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertNotEmpty($fields_results);
        $this->assertCount(count($fields), $fields_results[0]);

        $get_rule_id   = $fields_results[0]['id'];
        $fields_result = $api->rules()->get($get_rule_id, $fields, true);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertNotEmpty($fields_result);
        $this->assertCount(count($fields), $fields_result);
    }

    /**
     * Test that getAll method respects pagination.
     *
     * @return void
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     */
    public function testGetAllPagination()
    {
        $api           = new Management(self::$env['API_TOKEN'], self::$env['DOMAIN']);
        $paged_results = $api->rules()->getAll(null, null, null, 0, 2);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertCount(2, $paged_results);

        // Second page of 1 result.
        $paged_results_2 = $api->rules()->getAll(null, null, null, 1, 1);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertCount(1, $paged_results_2);
        $this->assertEquals($paged_results[1]['id'], $paged_results_2[0]['id']);
    }

    /**
     * Test that create, update, and delete methods work as expected.
     *
     * @return void
     *
     * @throws CoreException Thrown when there is a problem with parameters passed to the method.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     */
    public function testCreateUpdateDelete()
    {
        $api         = new Management(self::$env['API_TOKEN'], self::$env['DOMAIN']);
        $create_data = [
            'name' => 'test-create-rule-'.rand(),
            'script' => 'function (user, context, callback) { callback(null, user, context); }',
            'enabled' => true,
        ];

        $create_result = $api->rules()->create($create_data);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertNotEmpty($create_result['id']);
        $this->assertEquals($create_data['enabled'], $create_result['enabled']);
        $this->assertEquals($create_data['name'], $create_result['name']);
        $this->assertEquals($create_data['script'], $create_result['script']);

        $test_rule_id = $create_result['id'];
        $update_data  = [
            'name' => 'test-create-rule-'.rand(),
            'script' => 'function (user, context, cb) { cb(null, user, context); }',
            'enabled' => false,
        ];

        $update_result = $api->rules()->update($test_rule_id, $update_data);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertEquals($update_data['enabled'], $update_result['enabled']);
        $this->assertEquals($update_data['name'], $update_result['name']);
        $this->assertEquals($update_data['script'], $update_result['script']);

        $delete_result = $api->rules()->delete($test_rule_id);
        usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
        $this->assertNull($delete_result);
    }

}
