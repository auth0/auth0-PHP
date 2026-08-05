<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListAgentsResponseContent extends JsonSerializableType
{
    /**
     * @var array<AgentResponseContent> $agents
     */
    #[JsonProperty('agents'), ArrayType([AgentResponseContent::class])]
    private array $agents;

    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results. Omitted when there are no further results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   agents: array<AgentResponseContent>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->agents = $values['agents'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<AgentResponseContent>
     */
    public function getAgents(): array
    {
        return $this->agents;
    }

    /**
     * @param array<AgentResponseContent> $value
     */
    public function setAgents(array $value): self
    {
        $this->agents = $value;
        $this->_setField('agents');
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
