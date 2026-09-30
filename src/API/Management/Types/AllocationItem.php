<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class AllocationItem extends JsonSerializableType
{
    /**
     * @var ?string $variationId
     */
    #[JsonProperty('variation_id')]
    private ?string $variationId;

    /**
     * @var ?string $variationName
     */
    #[JsonProperty('variation_name')]
    private ?string $variationName;

    /**
     * @var ?string $segmentId
     */
    #[JsonProperty('segment_id')]
    private ?string $segmentId;

    /**
     * @var ?string $segmentName
     */
    #[JsonProperty('segment_name')]
    private ?string $segmentName;

    /**
     * @var ?int $weight
     */
    #[JsonProperty('weight')]
    private ?int $weight;

    /**
     * @var ?int $priority
     */
    #[JsonProperty('priority')]
    private ?int $priority;

    /**
     * @var ?bool $isControl
     */
    #[JsonProperty('is_control')]
    private ?bool $isControl;

    /**
     * @var ?bool $isFallback
     */
    #[JsonProperty('is_fallback')]
    private ?bool $isFallback;

    /**
     * @var ?array<string, mixed> $variationSnapshot
     */
    #[JsonProperty('variation_snapshot'), ArrayType(['string' => 'mixed'])]
    private ?array $variationSnapshot;

    /**
     * @var ?array<string, mixed> $segmentSnapshot
     */
    #[JsonProperty('segment_snapshot'), ArrayType(['string' => 'mixed'])]
    private ?array $segmentSnapshot;

    /**
     * @param array{
     *   variationId?: ?string,
     *   variationName?: ?string,
     *   segmentId?: ?string,
     *   segmentName?: ?string,
     *   weight?: ?int,
     *   priority?: ?int,
     *   isControl?: ?bool,
     *   isFallback?: ?bool,
     *   variationSnapshot?: ?array<string, mixed>,
     *   segmentSnapshot?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->variationId = $values['variationId'] ?? null;
        $this->variationName = $values['variationName'] ?? null;
        $this->segmentId = $values['segmentId'] ?? null;
        $this->segmentName = $values['segmentName'] ?? null;
        $this->weight = $values['weight'] ?? null;
        $this->priority = $values['priority'] ?? null;
        $this->isControl = $values['isControl'] ?? null;
        $this->isFallback = $values['isFallback'] ?? null;
        $this->variationSnapshot = $values['variationSnapshot'] ?? null;
        $this->segmentSnapshot = $values['segmentSnapshot'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getVariationId(): ?string
    {
        return $this->variationId;
    }

    /**
     * @param ?string $value
     */
    public function setVariationId(?string $value = null): self
    {
        $this->variationId = $value;
        $this->_setField('variationId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getVariationName(): ?string
    {
        return $this->variationName;
    }

    /**
     * @param ?string $value
     */
    public function setVariationName(?string $value = null): self
    {
        $this->variationName = $value;
        $this->_setField('variationName');
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
     * @return ?string
     */
    public function getSegmentName(): ?string
    {
        return $this->segmentName;
    }

    /**
     * @param ?string $value
     */
    public function setSegmentName(?string $value = null): self
    {
        $this->segmentName = $value;
        $this->_setField('segmentName');
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
     * @return ?bool
     */
    public function getIsControl(): ?bool
    {
        return $this->isControl;
    }

    /**
     * @param ?bool $value
     */
    public function setIsControl(?bool $value = null): self
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
     * @return ?array<string, mixed>
     */
    public function getVariationSnapshot(): ?array
    {
        return $this->variationSnapshot;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setVariationSnapshot(?array $value = null): self
    {
        $this->variationSnapshot = $value;
        $this->_setField('variationSnapshot');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getSegmentSnapshot(): ?array
    {
        return $this->segmentSnapshot;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setSegmentSnapshot(?array $value = null): self
    {
        $this->segmentSnapshot = $value;
        $this->_setField('segmentSnapshot');
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
