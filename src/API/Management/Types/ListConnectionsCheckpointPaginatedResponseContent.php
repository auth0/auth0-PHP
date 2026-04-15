<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListConnectionsCheckpointPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next Opaque identifier for use with the <i>from</i> query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var ?array<ConnectionForList> $connections
     */
    #[JsonProperty('connections'), ArrayType([ConnectionForList::class])]
    private ?array $connections;

    /**
     * @param array{
     *   next?: ?string,
     *   connections?: ?array<ConnectionForList>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->next = $values['next'] ?? null;
        $this->connections = $values['connections'] ?? null;
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
     * @return ?array<ConnectionForList>
     */
    public function getConnections(): ?array
    {
        return $this->connections;
    }

    /**
     * @param ?array<ConnectionForList> $value
     */
    public function setConnections(?array $value = null): self
    {
        $this->connections = $value;
        $this->_setField('connections');
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
