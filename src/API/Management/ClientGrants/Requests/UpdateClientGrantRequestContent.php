<?php

namespace Auth0\SDK\API\Management\ClientGrants\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\ClientGrantOrganizationNullableUsageEnum;

class UpdateClientGrantRequestContent extends JsonSerializableType
{
    /**
     * @var ?array<string> $scope Scopes allowed for this client grant.
     */
    #[JsonProperty('scope'), ArrayType(['string'])]
    private ?array $scope;

    /**
     * @var ?value-of<ClientGrantOrganizationNullableUsageEnum> $organizationUsage
     */
    #[JsonProperty('organization_usage')]
    private ?string $organizationUsage;

    /**
     * @var ?bool $allowAnyOrganization Controls allowing any organization to be used with this grant
     */
    #[JsonProperty('allow_any_organization')]
    private ?bool $allowAnyOrganization;

    /**
     * @var ?array<string> $authorizationDetailsTypes Types of authorization_details allowed for this client grant.
     */
    #[JsonProperty('authorization_details_types'), ArrayType(['string'])]
    private ?array $authorizationDetailsTypes;

    /**
     * @var ?bool $allowAllScopes If enabled, all scopes configured on the resource server are allowed for this grant.
     */
    #[JsonProperty('allow_all_scopes')]
    private ?bool $allowAllScopes;

    /**
     * @param array{
     *   scope?: ?array<string>,
     *   organizationUsage?: ?value-of<ClientGrantOrganizationNullableUsageEnum>,
     *   allowAnyOrganization?: ?bool,
     *   authorizationDetailsTypes?: ?array<string>,
     *   allowAllScopes?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->scope = $values['scope'] ?? null;
        $this->organizationUsage = $values['organizationUsage'] ?? null;
        $this->allowAnyOrganization = $values['allowAnyOrganization'] ?? null;
        $this->authorizationDetailsTypes = $values['authorizationDetailsTypes'] ?? null;
        $this->allowAllScopes = $values['allowAllScopes'] ?? null;
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
     * @return ?value-of<ClientGrantOrganizationNullableUsageEnum>
     */
    public function getOrganizationUsage(): ?string
    {
        return $this->organizationUsage;
    }

    /**
     * @param ?value-of<ClientGrantOrganizationNullableUsageEnum> $value
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
     * @return ?array<string>
     */
    public function getAuthorizationDetailsTypes(): ?array
    {
        return $this->authorizationDetailsTypes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAuthorizationDetailsTypes(?array $value = null): self
    {
        $this->authorizationDetailsTypes = $value;
        $this->_setField('authorizationDetailsTypes');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowAllScopes(): ?bool
    {
        return $this->allowAllScopes;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowAllScopes(?bool $value = null): self
    {
        $this->allowAllScopes = $value;
        $this->_setField('allowAllScopes');
        return $this;
    }
}
