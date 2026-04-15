<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListClientGrantPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next Opaque identifier for use with the <i>from</i> query parameter for the next page of results.<br/>This identifier is valid for 24 hours.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var ?array<ClientGrantResponseContent> $clientGrants
     */
    #[JsonProperty('client_grants'), ArrayType([ClientGrantResponseContent::class])]
    private ?array $clientGrants;

    /**
     * @param array{
     *   next?: ?string,
     *   clientGrants?: ?array<ClientGrantResponseContent>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->next = $values['next'] ?? null;
        $this->clientGrants = $values['clientGrants'] ?? null;
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
     * @return ?array<ClientGrantResponseContent>
     */
    public function getClientGrants(): ?array
    {
        return $this->clientGrants;
    }

    /**
     * @param ?array<ClientGrantResponseContent> $value
     */
    public function setClientGrants(?array $value = null): self
    {
        $this->clientGrants = $value;
        $this->_setField('clientGrants');
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
