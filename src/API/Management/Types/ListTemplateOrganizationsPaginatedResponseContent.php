<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListTemplateOrganizationsPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var array<OrganizationTemplateAssignedOrganization> $organizations The list of organizations assigned to this template.
     */
    #[JsonProperty('organizations'), ArrayType([OrganizationTemplateAssignedOrganization::class])]
    private array $organizations;

    /**
     * @param array{
     *   organizations: array<OrganizationTemplateAssignedOrganization>,
     *   next?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->next = $values['next'] ?? null;
        $this->organizations = $values['organizations'];
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
     * @return array<OrganizationTemplateAssignedOrganization>
     */
    public function getOrganizations(): array
    {
        return $this->organizations;
    }

    /**
     * @param array<OrganizationTemplateAssignedOrganization> $value
     */
    public function setOrganizations(array $value): self
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
