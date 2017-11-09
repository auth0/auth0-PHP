<?php

namespace Auth0\SDK\API\Helpers\State;

use Auth0\SDK\Store\SessionStore;
use Auth0\SDK\Exception\CoreException;

/*
 * This file is part of Auth0-PHP package.
 *
 * (c) Auth0
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

/**
 * This interface must be implemented by state handlers.
 *
 * @author Auth0
 */
class SessionStateHandler implements StateHandler 
{
    const STATE_NAME = 'webauth_state';

    private $store;

    /**
     * @param SessionStore $store
     */
    public function __construct(SessionStore $store) {
        $this->store = $store;
    }

    /**
     * Generate state value to be used for the state param value during authorization.
     * 
     * @return string
     */
    public function issue() {
        $state = uniqid('', true);
        $this->store->set(self::STATE_NAME, $state);
        return $state;
    }

    /**
     * Store a given state value to be used for the state param value during authorization.
     * 
     * @return string
     */
    public function store($state) {
        $this->store->set(self::STATE_NAME, $state);
    }

    /**
     * Return status that a state is currently stored in the handler.
     * 
     * @return bool
     */
    public function hasState() {
        return $this->store->get(self::STATE_NAME) !== null;
    }

    /**
     * Perform validation of the returned state with the previously generated state.
     * 
     * @param  string $state
     * 
     * @throws exception
     */
    public function validate($state) {
        $valid = $this->store->get(self::STATE_NAME) == $state;
        $this->store->delete(self::STATE_NAME);
        return $valid;
    }
}