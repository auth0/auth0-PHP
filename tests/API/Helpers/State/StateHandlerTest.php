<?php
namespace Auth0\Tests\Api\Helpers\State;

use Auth0\SDK\API\Helpers\State\SessionStateHandler;
use Auth0\SDK\Store\SessionStore;

class StateHandlerTest extends \PHPUnit_Framework_TestCase
{
    
    public function testStateStoredCorrectly()
    {
        // Suppress header sent error
        @$test_store = new SessionStore();
        $test_state = new SessionStateHandler($test_store);
        $uniqid = uniqid();
        $test_state->store($uniqid);
        
        $this->assertEquals($uniqid, $test_store->get(SessionStateHandler::STATE_NAME));
    }
    
    public function testStateIssuedCorrectly()
    {
        // Suppress header sent error
        @$test_store = new SessionStore();
        $test_state = new SessionStateHandler($test_store);
        $uniqid_returned = $test_state->issue();
        
        $this->assertEquals($uniqid_returned, $test_store->get(SessionStateHandler::STATE_NAME));
    }
    
    public function testStateValidatesCorrectly()
    {
        // Suppress header sent error
        @$test_store = new SessionStore();
        $test_state = new SessionStateHandler($test_store);
        $uniqid_returned_1 = $test_state->issue();
        
        $this->assertTrue($test_state->validate($uniqid_returned_1));
        $this->assertNull($test_store->get(SessionStateHandler::STATE_NAME));
    
        $uniqid_returned_2 = $test_state->issue();
        $this->assertFalse($test_state->validate($uniqid_returned_2 . 'false'));
    }
}
