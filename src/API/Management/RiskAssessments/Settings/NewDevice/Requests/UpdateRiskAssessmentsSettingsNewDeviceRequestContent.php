<?php

namespace Auth0\SDK\API\Management\RiskAssessments\Settings\NewDevice\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateRiskAssessmentsSettingsNewDeviceRequestContent extends JsonSerializableType
{
    /**
     * @var int $rememberFor Length of time to remember devices for, in days.
     */
    #[JsonProperty('remember_for')]
    private int $rememberFor;

    /**
     * @param array{
     *   rememberFor: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->rememberFor = $values['rememberFor'];
    }

    /**
     * @return int
     */
    public function getRememberFor(): int
    {
        return $this->rememberFor;
    }

    /**
     * @param int $value
     */
    public function setRememberFor(int $value): self
    {
        $this->rememberFor = $value;
        $this->_setField('rememberFor');
        return $this;
    }
}
