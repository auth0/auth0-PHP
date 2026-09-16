<?php

namespace Auth0\SDK\API\Management\Experimentation;

use Auth0\SDK\API\Management\Experimentation\Experiments\ExperimentsClientInterface;

interface ExperimentationClientInterface
{
    /**
     * @return ExperimentsClientInterface
     */
    public function getExperiments(): ExperimentsClientInterface;
}
