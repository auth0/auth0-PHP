<?php

namespace Auth0\SDK\API\Management\RiskAssessments;

use Auth0\SDK\API\Management\RiskAssessments\Settings\SettingsClientInterface;

interface RiskAssessmentsClientInterface
{
    /**
     * @return SettingsClientInterface
     */
    public function getSettings(): SettingsClientInterface;
}
