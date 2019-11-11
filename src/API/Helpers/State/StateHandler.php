<?php

namespace Auth0\SDK\API\Helpers\State;

/**
 * This interface must be implemented by state handlers.
 */
interface StateHandler
{

    /**
     * Generate state value to be used for the state param value during authorization.
     *
     * @return string || null
     */
    public function issue();

    /**
     * Store a given state value to be used for the state param value during authorization.
     *
     * @param $state
     *
     * @return mixed
     */
    public function store($state);

    /**
     * Perform validation of the returned state with the previously generated state.
     *
     * @param string $state
     *
     * @return boolean result
     *
     * @throws \Exception
     */
    public function validate($state);
}
