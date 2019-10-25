<?php

namespace Auth0\SDK\API\Helpers\State;

use Predis\Client;
use Auth0\SDK\API\Helpers\State\StateHandler;

/*
 * This file is part of Auth0-PHP package.
 *
 * (c) Auth0
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

/**
 * Redis based implementation of StateHandler.
 *
 * @author Auth0
 */
class RedisStateHandler implements StateHandler
{
    const STATE_NAME = 'webauth_state';

    private $cache;

    /**
     * Auth0RedisStateHandler constructor.
     *
     * @param Client $cache
     */
    public function __construct(Client $cache)
    {
        $this->cache = $cache;
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
        $this->cache->sadd(self::STATE_NAME, $state);
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
        $valid = $this->cache->sismember(self::STATE_NAME, $state) > 0;
        $this->cache->srem(self::STATE_NAME, $state);
        return $valid;
    }
}
