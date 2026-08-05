<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListOrganizationClientsResponseContent extends JsonSerializableType
{
    /**
     * @var array<OrganizationClient> $clients The list of clients associated with the organization.
     */
    #[JsonProperty('clients'), ArrayType([OrganizationClient::class])]
    private array $clients;

    /**
     * @var ?string $next An opaque token that, when present, can be passed as the `from` query parameter to retrieve the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   clients: array<OrganizationClient>,
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
     * @return array<OrganizationClient>
     */
    public function getClients(): array
    {
        return $this->clients;
    }

    /**
     * @param array<OrganizationClient> $value
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
