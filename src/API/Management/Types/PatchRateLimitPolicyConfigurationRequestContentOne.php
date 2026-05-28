<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PatchRateLimitPolicyConfigurationRequestContentOne extends JsonSerializableType
{
    /**
     * @var value-of<PatchRateLimitPolicyConfigurationRequestContentOneAction> $action Determines the action to take when the rate limit is exceeded.
     */
    #[JsonProperty('action')]
    private string $action;

    /**
     * @var int $limit The maximum number of requests allowed in a single refresh window.
     */
    #[JsonProperty('limit')]
    private int $limit;

    /**
     * @param array{
     *   action: value-of<PatchRateLimitPolicyConfigurationRequestContentOneAction>,
     *   limit: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->action = $values['action'];
        $this->limit = $values['limit'];
    }

    /**
     * @return value-of<PatchRateLimitPolicyConfigurationRequestContentOneAction>
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param value-of<PatchRateLimitPolicyConfigurationRequestContentOneAction> $value
     */
    public function setAction(string $value): self
    {
        $this->action = $value;
        $this->_setField('action');
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $value
     */
    public function setLimit(int $value): self
    {
        $this->limit = $value;
        $this->_setField('limit');
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
