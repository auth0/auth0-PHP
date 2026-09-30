<?php

namespace Auth0\SDK\API\Management\Experimentation;

use Auth0\SDK\API\Management\Experimentation\Experiments\ExperimentsClientInterface;
use Auth0\SDK\API\Management\Experimentation\FeatureFlags\FeatureFlagsClientInterface;
use Auth0\SDK\API\Management\Experimentation\Segments\SegmentsClientInterface;

interface ExperimentationClientInterface
{
    /**
     * @return ExperimentsClientInterface
     */
    public function getExperiments(): ExperimentsClientInterface;

    /**
     * @return FeatureFlagsClientInterface
     */
    public function getFeatureFlags(): FeatureFlagsClientInterface;

    /**
     * @return SegmentsClientInterface
     */
    public function getSegments(): SegmentsClientInterface;
}
