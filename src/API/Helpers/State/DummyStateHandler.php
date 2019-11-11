<?php

namespace Auth0\SDK\API\Helpers\State;

/**
 * Dummy implementation of the StateHandler
 */
class DummyStateHandler implements StateHandler
{
    /**
     * Generate state value to be used for the state param value during authorization.
     *
     * @return string|null
     */
    public function issue()
    {
        return null;
    }

    /**
     * Store state value to be used for the state param value during authorization.
     *
     * @param string $state
     *
     * @return string|void
     */
    public function store($state)
    {
    }

    /**
     * Perform validation of the returned state with the previously generated state.
     *
     * @param string $state
     *
     * @return boolean result
     *
     * @throws \Exception
     */
    public function validate($state)
    {
        return true;
    }
}
