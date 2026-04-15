<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListOrganizationDiscoveryDomainsResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var array<OrganizationDiscoveryDomain> $domains
     */
    #[JsonProperty('domains'), ArrayType([OrganizationDiscoveryDomain::class])]
    private array $domains;

    /**
     * @param array{
     *   domains: array<OrganizationDiscoveryDomain>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->next = $values['next'] ?? null;
        $this->domains = $values['domains'];
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
     * @return array<OrganizationDiscoveryDomain>
     */
    public function getDomains(): array
    {
        return $this->domains;
    }

    /**
     * @param array<OrganizationDiscoveryDomain> $value
     */
    public function setDomains(array $value): self
    {
        $this->domains = $value;
        $this->_setField('domains');
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
