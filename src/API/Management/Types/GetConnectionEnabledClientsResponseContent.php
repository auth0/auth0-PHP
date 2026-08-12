<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetConnectionEnabledClientsResponseContent extends JsonSerializableType
{
    /**
     * @var array<ConnectionEnabledClient> $clients Clients for which the connection is enabled
     */
    #[JsonProperty('clients'), ArrayType([ConnectionEnabledClient::class])]
    private array $clients;

    /**
     * @var ?string $next Encoded next token
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   clients: array<ConnectionEnabledClient>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->clients = $values['clients'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<ConnectionEnabledClient>
     */
    public function getClients(): array
    {
        return $this->clients;
    }

    /**
     * @param array<ConnectionEnabledClient> $value
     */
    public function setClients(array $value): self
    {
        $this->clients = $value;
        $this->_setField('clients');
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
