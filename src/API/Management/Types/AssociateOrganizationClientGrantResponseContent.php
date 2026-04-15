<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class AssociateOrganizationClientGrantResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id ID of the client grant.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $clientId ID of the client.
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?string $audience The audience (API identifier) of this client grant
     */
    #[JsonProperty('audience')]
    private ?string $audience;

    /**
     * @var ?array<string> $scope Scopes allowed for this client grant.
     */
    #[JsonProperty('scope'), ArrayType(['string'])]
    private ?array $scope;

    /**
     * @var ?value-of<OrganizationUsageEnum> $organizationUsage
     */
    #[JsonProperty('organization_usage')]
    private ?string $organizationUsage;

    /**
     * @var ?bool $allowAnyOrganization If enabled, any organization can be used with this grant. If disabled (default), the grant must be explicitly assigned to the desired organizations.
     */
    #[JsonProperty('allow_any_organization')]
    private ?bool $allowAnyOrganization;

    /**
     * @param array{
     *   id?: ?string,
     *   clientId?: ?string,
     *   audience?: ?string,
     *   scope?: ?array<string>,
     *   organizationUsage?: ?value-of<OrganizationUsageEnum>,
     *   allowAnyOrganization?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->audience = $values['audience'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->organizationUsage = $values['organizationUsage'] ?? null;
        $this->allowAnyOrganization = $values['allowAnyOrganization'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAudience(): ?string
    {
        return $this->audience;
    }

    /**
     * @param ?string $value
     */
    public function setAudience(?string $value = null): self
    {
        $this->audience = $value;
        $this->_setField('audience');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getScope(): ?array
    {
        return $this->scope;
    }

    /**
     * @param ?array<string> $value
     */
    public function setScope(?array $value = null): self
    {
        $this->scope = $value;
        $this->_setField('scope');
        return $this;
    }

    /**
     * @return ?value-of<OrganizationUsageEnum>
     */
    public function getOrganizationUsage(): ?string
    {
        return $this->organizationUsage;
    }

    /**
     * @param ?value-of<OrganizationUsageEnum> $value
     */
    public function setOrganizationUsage(?string $value = null): self
    {
        $this->organizationUsage = $value;
        $this->_setField('organizationUsage');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowAnyOrganization(): ?bool
    {
        return $this->allowAnyOrganization;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowAnyOrganization(?bool $value = null): self
    {
        $this->allowAnyOrganization = $value;
        $this->_setField('allowAnyOrganization');
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
