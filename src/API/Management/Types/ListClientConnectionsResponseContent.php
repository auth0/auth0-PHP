<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListClientConnectionsResponseContent extends JsonSerializableType
{
    /**
     * @var array<ConnectionForList> $connections
     */
    #[JsonProperty('connections'), ArrayType([ConnectionForList::class])]
    private array $connections;

    /**
     * @var ?string $next Encoded next token
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   connections: array<ConnectionForList>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connections = $values['connections'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<ConnectionForList>
     */
    public function getConnections(): array
    {
        return $this->connections;
    }

    /**
     * @param array<ConnectionForList> $value
     */
    public function setConnections(array $value): self
    {
        $this->connections = $value;
        $this->_setField('connections');
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
