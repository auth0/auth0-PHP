<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class AllocationRequestItem extends JsonSerializableType
{
    /**
     * @var string $variationId The ID of the variation to allocate
     */
    #[JsonProperty('variation_id')]
    private string $variationId;

    /**
     * @var ?int $weight Percentage weight for this allocation (percentage strategy only)
     */
    #[JsonProperty('weight')]
    private ?int $weight;

    /**
     * @var ?string $segmentId The segment this allocation targets (segment strategy only)
     */
    #[JsonProperty('segment_id')]
    private ?string $segmentId;

    /**
     * @var ?int $priority Evaluation order; 1 = highest priority (segment strategy only)
     */
    #[JsonProperty('priority')]
    private ?int $priority;

    /**
     * @var bool $isControl Whether this allocation is the control group
     */
    #[JsonProperty('is_control')]
    private bool $isControl;

    /**
     * @var ?bool $isFallback Whether this allocation is the default fallback (segment strategy only)
     */
    #[JsonProperty('is_fallback')]
    private ?bool $isFallback;

    /**
     * @param array{
     *   variationId: string,
     *   isControl: bool,
     *   weight?: ?int,
     *   segmentId?: ?string,
     *   priority?: ?int,
     *   isFallback?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->variationId = $values['variationId'];
        $this->weight = $values['weight'] ?? null;
        $this->segmentId = $values['segmentId'] ?? null;
        $this->priority = $values['priority'] ?? null;
        $this->isControl = $values['isControl'];
        $this->isFallback = $values['isFallback'] ?? null;
    }

    /**
     * @return string
     */
    public function getVariationId(): string
    {
        return $this->variationId;
    }

    /**
     * @param string $value
     */
    public function setVariationId(string $value): self
    {
        $this->variationId = $value;
        $this->_setField('variationId');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param ?int $value
     */
    public function setWeight(?int $value = null): self
    {
        $this->weight = $value;
        $this->_setField('weight');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSegmentId(): ?string
    {
        return $this->segmentId;
    }

    /**
     * @param ?string $value
     */
    public function setSegmentId(?string $value = null): self
    {
        $this->segmentId = $value;
        $this->_setField('segmentId');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param ?int $value
     */
    public function setPriority(?int $value = null): self
    {
        $this->priority = $value;
        $this->_setField('priority');
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsControl(): bool
    {
        return $this->isControl;
    }

    /**
     * @param bool $value
     */
    public function setIsControl(bool $value): self
    {
        $this->isControl = $value;
        $this->_setField('isControl');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsFallback(): ?bool
    {
        return $this->isFallback;
    }

    /**
     * @param ?bool $value
     */
    public function setIsFallback(?bool $value = null): self
    {
        $this->isFallback = $value;
        $this->_setField('isFallback');
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
