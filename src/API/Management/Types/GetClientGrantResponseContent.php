<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetClientGrantResponseContent extends JsonSerializableType
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
     * @var ?string $audience The audience (API identifier) of this client grant.
     */
    #[JsonProperty('audience')]
    private ?string $audience;

    /**
     * @var ?array<string> $scope Scopes allowed for this client grant.
     */
    #[JsonProperty('scope'), ArrayType(['string'])]
    private ?array $scope;

    /**
     * @var ?value-of<ClientGrantOrganizationUsageEnum> $organizationUsage
     */
    #[JsonProperty('organization_usage')]
    private ?string $organizationUsage;

    /**
     * @var ?bool $allowAnyOrganization If enabled, any organization can be used with this grant. If disabled (default), the grant must be explicitly assigned to the desired organizations.
     */
    #[JsonProperty('allow_any_organization')]
    private ?bool $allowAnyOrganization;

    /**
     * @var ?bool $isSystem If enabled, this grant is a special grant created by Auth0. It cannot be modified or deleted directly.
     */
    #[JsonProperty('is_system')]
    private ?bool $isSystem;

    /**
     * @var ?value-of<ClientGrantSubjectTypeEnum> $subjectType
     */
    #[JsonProperty('subject_type')]
    private ?string $subjectType;

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
     *   id?: ?string,
     *   clientId?: ?string,
     *   audience?: ?string,
     *   scope?: ?array<string>,
     *   organizationUsage?: ?value-of<ClientGrantOrganizationUsageEnum>,
     *   allowAnyOrganization?: ?bool,
     *   isSystem?: ?bool,
     *   subjectType?: ?value-of<ClientGrantSubjectTypeEnum>,
     *   authorizationDetailsTypes?: ?array<string>,
     *   allowAllScopes?: ?bool,
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
        $this->isSystem = $values['isSystem'] ?? null;
        $this->subjectType = $values['subjectType'] ?? null;
        $this->authorizationDetailsTypes = $values['authorizationDetailsTypes'] ?? null;
        $this->allowAllScopes = $values['allowAllScopes'] ?? null;
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
     * @return ?value-of<ClientGrantOrganizationUsageEnum>
     */
    public function getOrganizationUsage(): ?string
    {
        return $this->organizationUsage;
    }

    /**
     * @param ?value-of<ClientGrantOrganizationUsageEnum> $value
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
     * @return ?bool
     */
    public function getIsSystem(): ?bool
    {
        return $this->isSystem;
    }

    /**
     * @param ?bool $value
     */
    public function setIsSystem(?bool $value = null): self
    {
        $this->isSystem = $value;
        $this->_setField('isSystem');
        return $this;
    }

    /**
     * @return ?value-of<ClientGrantSubjectTypeEnum>
     */
    public function getSubjectType(): ?string
    {
        return $this->subjectType;
    }

    /**
     * @param ?value-of<ClientGrantSubjectTypeEnum> $value
     */
    public function setSubjectType(?string $value = null): self
    {
        $this->subjectType = $value;
        $this->_setField('subjectType');
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
