<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class SearchOrganizationsPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var array<SearchOrganization> $organizations
     */
    #[JsonProperty('organizations'), ArrayType([SearchOrganization::class])]
    private array $organizations;

    /**
     * @var ?string $next Cursor for retrieving the next page of results. Absent when no more results are available.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @param array{
     *   organizations: array<SearchOrganization>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organizations = $values['organizations'];
        $this->next = $values['next'] ?? null;
    }

    /**
     * @return array<SearchOrganization>
     */
    public function getOrganizations(): array
    {
        return $this->organizations;
    }

    /**
     * @param array<SearchOrganization> $value
     */
    public function setOrganizations(array $value): self
    {
        $this->organizations = $value;
        $this->_setField('organizations');
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
