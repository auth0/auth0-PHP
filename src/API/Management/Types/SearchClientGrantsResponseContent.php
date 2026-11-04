<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class SearchClientGrantsResponseContent extends JsonSerializableType
{
    /**
     * @var array<ClientGrantResponseContent> $clientGrants Array of client grant objects matching the search criteria.
     */
    #[JsonProperty('client_grants'), ArrayType([ClientGrantResponseContent::class])]
    private array $clientGrants;

    /**
     * @var ?string $next Cursor for retrieving the next page of results. Omitted if there are no more results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   clientGrants: array<ClientGrantResponseContent>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->clientGrants = $values['clientGrants'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<ClientGrantResponseContent>
     */
    public function getClientGrants(): array
    {
        return $this->clientGrants;
    }

    /**
     * @param array<ClientGrantResponseContent> $value
     */
    public function setClientGrants(array $value): self
    {
        $this->clientGrants = $value;
        $this->_setField('clientGrants');
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
