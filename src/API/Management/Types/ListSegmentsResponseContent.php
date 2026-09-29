<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListSegmentsResponseContent extends JsonSerializableType
{
    /**
     * @var array<Segment> $segments
     */
    #[JsonProperty('segments'), ArrayType([Segment::class])]
    private array $segments;

    /**
     * @var ?string $next Checkpoint token for the next page. Omitted when there are no further results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   segments: array<Segment>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->segments = $values['segments'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<Segment>
     */
    public function getSegments(): array
    {
        return $this->segments;
    }

    /**
     * @param array<Segment> $value
     */
    public function setSegments(array $value): self
    {
        $this->segments = $value;
        $this->_setField('segments');
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
