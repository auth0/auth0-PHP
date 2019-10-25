<?php
namespace Auth0\Tests\Api\Helpers\State;

use Auth0\SDK\API\Helpers\State\RedisStateHandler;
use Predis\Client;

/**
 * Class RedisStateHandlerTest
 *
 * @package Auth0\Tests\Api\Helpers\State
 */
class RedisStateHandlerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Storage engine to use.
     *
     * @var Client
     */
    private $cache;

    /**
     * State handler to use.
     *
     * @var RedisStateHandler
     */
    private $stateHandler;

    /**
     * RedisStateHandlerTest constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->cache = new Client();
        $this->stateHandler = new RedisStateHandler($this->cache);
    }

    /**
     * Test that state is stored and retrieved properly.
     *
     * @return void
     */
    public function testStateStoredCorrectly()
    {
        $uniqid = uniqid();

        $this->stateHandler->store($uniqid);
        $this->assertGreaterThan(0, $this->cache->sismember(RedisStateHandler::STATE_NAME, $uniqid));
    }

    /**
     * Test that the state is being issued correctly.
     *
     * @return void
     */
    public function testStateIssuedCorrectly()
    {
        $state_issued = $this->stateHandler->issue();
        $this->assertGreaterThan(0, $this->cache->sismember(RedisStateHandler::STATE_NAME, $state_issued));
    }

    /**
     * Test that state validated properly.
     *
     * @return void
     */
    public function testStateValidatesCorrectly()
    {
        $state_issued = $this->stateHandler->issue();
        $this->assertTrue($this->stateHandler->validate($state_issued));
        $this->assertEquals(0, $this->cache->sismember(RedisStateHandler::STATE_NAME, $state_issued));

    }

    /**
     * Test that state validation fails with an incorrect value.
     *
     * @return void
     */
    public function testStateFailsWithIncorrectValue()
    {
        $state_issued = $this->stateHandler->issue();
        $this->assertFalse($this->stateHandler->validate($state_issued.'false'));
    }
}
