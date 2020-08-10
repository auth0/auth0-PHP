<?php
namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Management;
use Auth0\SDK\Exception\CoreException;

use Auth0\Tests\API\ApiTests;

/**
 * Class RulesTest.
 *
 * @package Auth0\Tests\unit\API\Management
 */
class RulesTest extends ApiTests
{

    /**
     * Test that exceptions are thrown for specific methods in specific cases.
     *
     * @return void
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     */
    public function testExceptions()
    {
        $api = new Management(uniqid(), uniqid());

        // Test that the get method throws an exception if the $id parameter is empty.
        $caught_get_no_id_exception = false;
        try {
            $api->rules()->get(null);
        } catch (CoreException $e) {
            $caught_get_no_id_exception = $this->errorHasString($e, 'Invalid "id" parameter');
        }

        $this->assertTrue($caught_get_no_id_exception);

        // Test that the delete method throws an exception if the $id parameter is empty.
        $caught_delete_no_id_exception = false;
        try {
            $api->rules()->delete(null);
        } catch (CoreException $e) {
            $caught_delete_no_id_exception = $this->errorHasString($e, 'Invalid "id" parameter');
        }

        $this->assertTrue($caught_delete_no_id_exception);

        // Test that the create method throws an exception if no "name" field is passed.
        $caught_create_no_name_exception = false;
        try {
            $api->rules()->create(['script' => 'function(){}']);
        } catch (CoreException $e) {
            $caught_create_no_name_exception = $this->errorHasString($e, 'Missing required "name" field');
        }

        $this->assertTrue($caught_create_no_name_exception);

        // Test that the create method throws an exception if no "script" field is passed.
        $caught_create_no_script_exception = false;
        try {
            $api->rules()->create(['name' => 'test-create-rule-'.rand()]);
        } catch (CoreException $e) {
            $caught_create_no_script_exception = $this->errorHasString($e, 'Missing required "script" field');
        }

        $this->assertTrue($caught_create_no_script_exception);

        // Test that the update method throws an exception if the $id parameter is empty.
        $caught_update_no_id_exception = false;
        try {
            $api->rules()->update(null, []);
        } catch (CoreException $e) {
            $caught_update_no_id_exception = $this->errorHasString($e, 'Invalid "id" parameter');
        }

        $this->assertTrue($caught_update_no_id_exception);
    }
}
