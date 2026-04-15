<?php

namespace Auth0\SDK\API\Management\RiskAssessments\Settings\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateRiskAssessmentsSettingsRequestContent extends JsonSerializableType
{
    /**
     * @var bool $enabled Whether or not risk assessment is enabled.
     */
    #[JsonProperty('enabled')]
    private bool $enabled;

    /**
     * @param array{
     *   enabled: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->enabled = $values['enabled'];
    }

    /**
     * @return bool
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $value
     */
    public function setEnabled(bool $value): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
        return $this;
    }
}
