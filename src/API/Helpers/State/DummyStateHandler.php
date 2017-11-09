<?php

namespace Auth0\SDK\API\Helpers\State;

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
class DummyStateHandler implements StateHandler 
{
    /**
     * Generate state value to be used for the state param value during authorization.
     * 
     * @return string
     */
    public function issue() {
        return null;
    }

    /**
     * Store state value to be used for the state param value during authorization.
     * 
     */
    public function state($state) {
    }

    /**
     * Return status that a state is currently stored in the handler.
     * 
     * @return bool
     */
    public function hasState() {
        return true;
    }

    /**
     * Perform validation of the returned state with the previously generated state.
     * 
     * @param  string $state
     * 
     * @return bool result
     * @throws exception
     */
    public function validate($state) {
        return true;
    }
}