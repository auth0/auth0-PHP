<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PatchRateLimitPolicyConfigurationRequestContentZero extends JsonSerializableType
{
    /**
     * @var value-of<PatchRateLimitPolicyConfigurationRequestContentZeroAction> $action Determines the action to take when the rate limit is exceeded.
     */
    #[JsonProperty('action')]
    private string $action;

    /**
     * @param array{
     *   action: value-of<PatchRateLimitPolicyConfigurationRequestContentZeroAction>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->action = $values['action'];
    }

    /**
     * @return value-of<PatchRateLimitPolicyConfigurationRequestContentZeroAction>
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param value-of<PatchRateLimitPolicyConfigurationRequestContentZeroAction> $value
     */
    public function setAction(string $value): self
    {
        $this->action = $value;
        $this->_setField('action');
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
