<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class OrganizationTemplate extends JsonSerializableType
{
    /**
     * @var ?string $id Organization Template identifier.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name The name of the organization template.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?bool $isDefault Whether this is the default template applied to new organizations.
     */
    #[JsonProperty('is_default')]
    private ?bool $isDefault;

    /**
     * @var ?value-of<OrganizationDeletionBehaviorEnum> $organizationDeletionBehavior
     */
    #[JsonProperty('organization_deletion_behavior')]
    private ?string $organizationDeletionBehavior;

    /**
     * @var ?value-of<ConnectionDeletionBehaviorEnum> $connectionDeletionBehavior
     */
    #[JsonProperty('connection_deletion_behavior')]
    private ?string $connectionDeletionBehavior;

    /**
     * @var ?bool $enforcePermissionCeiling Whether to enforce permission ceiling for organizations using this template.
     */
    #[JsonProperty('enforce_permission_ceiling')]
    private ?bool $enforcePermissionCeiling;

    /**
     * @var ?bool $enforceSelfAssignmentRestriction Whether to enforce self-assignment restrictions for organizations using this template.
     */
    #[JsonProperty('enforce_self_assignment_restriction')]
    private ?bool $enforceSelfAssignmentRestriction;

    /**
     * @var ?string $connectionProfileId The connection profile to apply to new connections.
     */
    #[JsonProperty('connection_profile_id')]
    private ?string $connectionProfileId;

    /**
     * @var ?string $userAttributeProfileId The user attribute profile to apply to organizations.
     */
    #[JsonProperty('user_attribute_profile_id')]
    private ?string $userAttributeProfileId;

    /**
     * @var ?array<value-of<OrganizationTemplateAllowedStrategyEnum>> $allowedStrategies List of allowed connection strategies for this template.
     */
    #[JsonProperty('allowed_strategies'), ArrayType(['string'])]
    private ?array $allowedStrategies;

    /**
     * @var ?string $invitationLandingClientId The client ID for the invitation landing page.
     */
    #[JsonProperty('invitation_landing_client_id')]
    private ?string $invitationLandingClientId;

    /**
     * @var ?array<string> $adminRolesAssignment Default admin roles to assign to organization creators.
     */
    #[JsonProperty('admin_roles_assignment'), ArrayType(['string'])]
    private ?array $adminRolesAssignment;

    /**
     * @var ?OrganizationTemplateUseForOrganizationDiscovery $useForOrganizationDiscovery
     */
    #[JsonProperty('use_for_organization_discovery')]
    private ?OrganizationTemplateUseForOrganizationDiscovery $useForOrganizationDiscovery;

    /**
     * @var ?OrganizationTemplateRoleVisibilityPolicy $roleVisibilityPolicy
     */
    #[JsonProperty('role_visibility_policy')]
    private ?OrganizationTemplateRoleVisibilityPolicy $roleVisibilityPolicy;

    /**
     * @var ?DateTime $createdAt The ISO 8601 formatted timestamp representing when the template was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt The ISO 8601 formatted timestamp representing when the template was last updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   isDefault?: ?bool,
     *   organizationDeletionBehavior?: ?value-of<OrganizationDeletionBehaviorEnum>,
     *   connectionDeletionBehavior?: ?value-of<ConnectionDeletionBehaviorEnum>,
     *   enforcePermissionCeiling?: ?bool,
     *   enforceSelfAssignmentRestriction?: ?bool,
     *   connectionProfileId?: ?string,
     *   userAttributeProfileId?: ?string,
     *   allowedStrategies?: ?array<value-of<OrganizationTemplateAllowedStrategyEnum>>,
     *   invitationLandingClientId?: ?string,
     *   adminRolesAssignment?: ?array<string>,
     *   useForOrganizationDiscovery?: ?OrganizationTemplateUseForOrganizationDiscovery,
     *   roleVisibilityPolicy?: ?OrganizationTemplateRoleVisibilityPolicy,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->isDefault = $values['isDefault'] ?? null;
        $this->organizationDeletionBehavior = $values['organizationDeletionBehavior'] ?? null;
        $this->connectionDeletionBehavior = $values['connectionDeletionBehavior'] ?? null;
        $this->enforcePermissionCeiling = $values['enforcePermissionCeiling'] ?? null;
        $this->enforceSelfAssignmentRestriction = $values['enforceSelfAssignmentRestriction'] ?? null;
        $this->connectionProfileId = $values['connectionProfileId'] ?? null;
        $this->userAttributeProfileId = $values['userAttributeProfileId'] ?? null;
        $this->allowedStrategies = $values['allowedStrategies'] ?? null;
        $this->invitationLandingClientId = $values['invitationLandingClientId'] ?? null;
        $this->adminRolesAssignment = $values['adminRolesAssignment'] ?? null;
        $this->useForOrganizationDiscovery = $values['useForOrganizationDiscovery'] ?? null;
        $this->roleVisibilityPolicy = $values['roleVisibilityPolicy'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    /**
     * @param ?bool $value
     */
    public function setIsDefault(?bool $value = null): self
    {
        $this->isDefault = $value;
        $this->_setField('isDefault');
        return $this;
    }

    /**
     * @return ?value-of<OrganizationDeletionBehaviorEnum>
     */
    public function getOrganizationDeletionBehavior(): ?string
    {
        return $this->organizationDeletionBehavior;
    }

    /**
     * @param ?value-of<OrganizationDeletionBehaviorEnum> $value
     */
    public function setOrganizationDeletionBehavior(?string $value = null): self
    {
        $this->organizationDeletionBehavior = $value;
        $this->_setField('organizationDeletionBehavior');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionDeletionBehaviorEnum>
     */
    public function getConnectionDeletionBehavior(): ?string
    {
        return $this->connectionDeletionBehavior;
    }

    /**
     * @param ?value-of<ConnectionDeletionBehaviorEnum> $value
     */
    public function setConnectionDeletionBehavior(?string $value = null): self
    {
        $this->connectionDeletionBehavior = $value;
        $this->_setField('connectionDeletionBehavior');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnforcePermissionCeiling(): ?bool
    {
        return $this->enforcePermissionCeiling;
    }

    /**
     * @param ?bool $value
     */
    public function setEnforcePermissionCeiling(?bool $value = null): self
    {
        $this->enforcePermissionCeiling = $value;
        $this->_setField('enforcePermissionCeiling');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnforceSelfAssignmentRestriction(): ?bool
    {
        return $this->enforceSelfAssignmentRestriction;
    }

    /**
     * @param ?bool $value
     */
    public function setEnforceSelfAssignmentRestriction(?bool $value = null): self
    {
        $this->enforceSelfAssignmentRestriction = $value;
        $this->_setField('enforceSelfAssignmentRestriction');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getConnectionProfileId(): ?string
    {
        return $this->connectionProfileId;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionProfileId(?string $value = null): self
    {
        $this->connectionProfileId = $value;
        $this->_setField('connectionProfileId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserAttributeProfileId(): ?string
    {
        return $this->userAttributeProfileId;
    }

    /**
     * @param ?string $value
     */
    public function setUserAttributeProfileId(?string $value = null): self
    {
        $this->userAttributeProfileId = $value;
        $this->_setField('userAttributeProfileId');
        return $this;
    }

    /**
     * @return ?array<value-of<OrganizationTemplateAllowedStrategyEnum>>
     */
    public function getAllowedStrategies(): ?array
    {
        return $this->allowedStrategies;
    }

    /**
     * @param ?array<value-of<OrganizationTemplateAllowedStrategyEnum>> $value
     */
    public function setAllowedStrategies(?array $value = null): self
    {
        $this->allowedStrategies = $value;
        $this->_setField('allowedStrategies');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getInvitationLandingClientId(): ?string
    {
        return $this->invitationLandingClientId;
    }

    /**
     * @param ?string $value
     */
    public function setInvitationLandingClientId(?string $value = null): self
    {
        $this->invitationLandingClientId = $value;
        $this->_setField('invitationLandingClientId');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getAdminRolesAssignment(): ?array
    {
        return $this->adminRolesAssignment;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAdminRolesAssignment(?array $value = null): self
    {
        $this->adminRolesAssignment = $value;
        $this->_setField('adminRolesAssignment');
        return $this;
    }

    /**
     * @return ?OrganizationTemplateUseForOrganizationDiscovery
     */
    public function getUseForOrganizationDiscovery(): ?OrganizationTemplateUseForOrganizationDiscovery
    {
        return $this->useForOrganizationDiscovery;
    }

    /**
     * @param ?OrganizationTemplateUseForOrganizationDiscovery $value
     */
    public function setUseForOrganizationDiscovery(?OrganizationTemplateUseForOrganizationDiscovery $value = null): self
    {
        $this->useForOrganizationDiscovery = $value;
        $this->_setField('useForOrganizationDiscovery');
        return $this;
    }

    /**
     * @return ?OrganizationTemplateRoleVisibilityPolicy
     */
    public function getRoleVisibilityPolicy(): ?OrganizationTemplateRoleVisibilityPolicy
    {
        return $this->roleVisibilityPolicy;
    }

    /**
     * @param ?OrganizationTemplateRoleVisibilityPolicy $value
     */
    public function setRoleVisibilityPolicy(?OrganizationTemplateRoleVisibilityPolicy $value = null): self
    {
        $this->roleVisibilityPolicy = $value;
        $this->_setField('roleVisibilityPolicy');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setCreatedAt(?DateTime $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setUpdatedAt(?DateTime $value = null): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
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
