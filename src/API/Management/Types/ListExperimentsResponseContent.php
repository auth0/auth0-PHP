<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListExperimentsResponseContent extends JsonSerializableType
{
    /**
     * @var array<ExperimentListItem> $experiments
     */
    #[JsonProperty('experiments'), ArrayType([ExperimentListItem::class])]
    private array $experiments;

    /**
     * @var ?string $next Checkpoint token for the next page. Omitted when there are no further results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   experiments: array<ExperimentListItem>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->experiments = $values['experiments'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<ExperimentListItem>
     */
    public function getExperiments(): array
    {
        return $this->experiments;
    }

    /**
     * @param array<ExperimentListItem> $value
     */
    public function setExperiments(array $value): self
    {
        $this->experiments = $value;
        $this->_setField('experiments');
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
