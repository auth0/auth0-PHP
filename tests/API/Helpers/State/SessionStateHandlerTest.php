<?php
namespace Auth0\Tests\Api\Helpers\State;

use Auth0\SDK\API\Helpers\State\SessionStateHandler;
use Auth0\SDK\Store\SessionStore;

/**
 * Class SessionStateHandlerTest
 *
 * @package Auth0\Tests\Api\Helpers\State
 */
class SessionStateHandlerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Storage engine to use.
     *
     * @var SessionStore
     */
    private $store;

    /**
     * State handler to use.
     *
     * @var SessionStateHandler
     */
    private $state;

    /**
     * SessionStateHandlerTest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // Suppress header sent error
        @$this->store = new SessionStore();
        $this->state = new SessionStateHandler($this->store);
    }

    /**
     * Test that state is stored and retrieved properly.
     */
    public function testStateStoredCorrectly()
    {
        $uniqid = uniqid();
        $this->state->store($uniqid);
        $this->assertEquals($uniqid, $this->store->get(SessionStateHandler::STATE_NAME));
    }

    /**
     * Test that the state is being issued correctly.
     */
    public function testStateIssuedCorrectly()
    {
        $state_issued = $this->state->issue();
        $this->assertEquals($state_issued, $this->store->get(SessionStateHandler::STATE_NAME));
    }

    /**
     * Test that state validated properly.
     *
     * @throws \Exception
     */
    public function testStateValidatesCorrectly()
    {
        $state_issued = $this->state->issue();
        $this->assertTrue($this->state->validate($state_issued));
        $this->assertNull($this->store->get(SessionStateHandler::STATE_NAME));
        $this->assertFalse($this->state->validate($state_issued . 'false'));
    }
}
