<?php

namespace Auth0\SDK\API\Management\Experimentation\FeatureFlags\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\FeatureFlagTypeEnum;
use Auth0\SDK\API\Management\Types\FeatureFlagStatusEnum;

class ListFeatureFlagsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $from Optional Id from which to start selection.
     */
    private ?string $from;

    /**
     * @var ?int $take Number of feature flags to return per page. Defaults to 25, maximum 50.
     */
    private ?int $take = 50;

    /**
     * @var ?value-of<FeatureFlagTypeEnum> $type Filter by type. Exact match.
     */
    private ?string $type;

    /**
     * @var ?value-of<FeatureFlagStatusEnum> $status Filter by status. Exact match.
     */
    private ?string $status;

    /**
     * @param array{
     *   from?: ?string,
     *   take?: ?int,
     *   type?: ?value-of<FeatureFlagTypeEnum>,
     *   status?: ?value-of<FeatureFlagStatusEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->status = $values['status'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param ?string $value
     */
    public function setFrom(?string $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTake(): ?int
    {
        return $this->take;
    }

    /**
     * @param ?int $value
     */
    public function setTake(?int $value = null): self
    {
        $this->take = $value;
        $this->_setField('take');
        return $this;
    }

    /**
     * @return ?value-of<FeatureFlagTypeEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<FeatureFlagTypeEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?value-of<FeatureFlagStatusEnum>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<FeatureFlagStatusEnum> $value
     */
    public function setStatus(?string $value = null): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }
}
