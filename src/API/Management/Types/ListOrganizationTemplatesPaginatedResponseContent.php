<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListOrganizationTemplatesPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var ?array<OrganizationTemplate> $organizationTemplates
     */
    #[JsonProperty('organization_templates'), ArrayType([OrganizationTemplate::class])]
    private ?array $organizationTemplates;

    /**
     * @param array{
     *   next?: ?string,
     *   organizationTemplates?: ?array<OrganizationTemplate>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->next = $values['next'] ?? null;
        $this->organizationTemplates = $values['organizationTemplates'] ?? null;
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
     * @return ?array<OrganizationTemplate>
     */
    public function getOrganizationTemplates(): ?array
    {
        return $this->organizationTemplates;
    }

    /**
     * @param ?array<OrganizationTemplate> $value
     */
    public function setOrganizationTemplates(?array $value = null): self
    {
        $this->organizationTemplates = $value;
        $this->_setField('organizationTemplates');
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
