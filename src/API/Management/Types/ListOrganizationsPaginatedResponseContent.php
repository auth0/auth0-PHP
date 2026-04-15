<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListOrganizationsPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var ?array<Organization> $organizations
     */
    #[JsonProperty('organizations'), ArrayType([Organization::class])]
    private ?array $organizations;

    /**
     * @param array{
     *   next?: ?string,
     *   organizations?: ?array<Organization>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->next = $values['next'] ?? null;
        $this->organizations = $values['organizations'] ?? null;
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
     * @return ?array<Organization>
     */
    public function getOrganizations(): ?array
    {
        return $this->organizations;
    }

    /**
     * @param ?array<Organization> $value
     */
    public function setOrganizations(?array $value = null): self
    {
        $this->organizations = $value;
        $this->_setField('organizations');
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
