<?php

namespace Auth0\SDK\API\Management\Experimentation\FeatureFlags\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\FeatureFlagStatusEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateFeatureFlagStatusRequestContent extends JsonSerializableType
{
    /**
     * @var value-of<FeatureFlagStatusEnum> $status The target status to transition the feature flag to.
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @param array{
     *   status: value-of<FeatureFlagStatusEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
    }

    /**
     * @return value-of<FeatureFlagStatusEnum>
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param value-of<FeatureFlagStatusEnum> $value
     */
    public function setStatus(string $value): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }
}
