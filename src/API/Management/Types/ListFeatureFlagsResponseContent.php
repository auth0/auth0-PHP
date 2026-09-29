<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListFeatureFlagsResponseContent extends JsonSerializableType
{
    /**
     * @var array<FeatureFlag> $featureFlags
     */
    #[JsonProperty('feature_flags'), ArrayType([FeatureFlag::class])]
    private array $featureFlags;

    /**
     * @var ?string $next Checkpoint token for the next page. Omitted when there are no further results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   featureFlags: array<FeatureFlag>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->featureFlags = $values['featureFlags'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<FeatureFlag>
     */
    public function getFeatureFlags(): array
    {
        return $this->featureFlags;
    }

    /**
     * @param array<FeatureFlag> $value
     */
    public function setFeatureFlags(array $value): self
    {
        $this->featureFlags = $value;
        $this->_setField('featureFlags');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getNext(): ?string
    {
        return $this->next;
    }

    /**
     * @param ?string $value
     */
    public function setNext(?string $value = null): self
    {
        $this->next = $value;
        $this->_setField('next');
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
