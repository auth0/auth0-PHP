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
     * Perform validation of the returned state with the previously generated state.
     * 
     * @param  string $state
     * 
     */
    public function validate($state) {
    }
}