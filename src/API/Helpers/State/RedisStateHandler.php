<?php

namespace Auth0\SDK\API\Helpers\State;

use Predis\Client;
use Auth0\SDK\API\Helpers\State\StateHandler;

/**
 * Redis based implementation of StateHandler.
 *
 * @author Brian Anderson
 */
class RedisStateHandler implements StateHandler
{
    const STATE_NAME = 'webauth_state';

    private $redis;

    /**
     * RedisStateHandler constructor.
     *
     * @param Client $redis
     */
    public function __construct(Client $redis)
    {
        $this->redis = $redis;
    }

    /**
     * Generate state value to be used for the state param value during authorization.
     *
     * @return string
     */
    public function issue()
    {
        $state = uniqid('', true);
        $this->store($state);
        return $state;
    }

    /**
     * Store a given state value to be used for the state param value during authorization.
     *
     * @param string $state
     *
     * @return mixed|void
     */
    public function store($state)
    {
        $this->redis->sadd(self::STATE_NAME, $state);
    }

    /**
     * Perform validation of the returned state with the previously generated state.
     *
     * @param string $state
     *
     * @return boolean
     */
    public function validate($state)
    {
        $valid = $this->redis->sismember(self::STATE_NAME, $state) > 0;
        $this->redis->srem(self::STATE_NAME, $state);
        return $valid;
    }
}
