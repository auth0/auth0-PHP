<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Configuration related to the My Organization Configuration for the client.
 */
class ClientMyOrganizationResponseConfiguration extends JsonSerializableType
{
    /**
     * @var ?string $connectionProfileId The connection profile ID that this client should validate against.
     */
    #[JsonProperty('connection_profile_id')]
    private ?string $connectionProfileId;

    /**
     * @var ?string $userAttributeProfileId The user attribute profile ID that this client should validate against.
     */
    #[JsonProperty('user_attribute_profile_id')]
    private ?string $userAttributeProfileId;

    /**
     * @var array<value-of<ClientMyOrganizationConfigurationAllowedStrategiesEnum>> $allowedStrategies The allowed connection strategies for the My Organization Configuration.
     */
    #[JsonProperty('allowed_strategies'), ArrayType(['string'])]
    private array $allowedStrategies;

    /**
     * @var ?ClientMyOrganizationThirdPartyClientAccessConfiguration $thirdPartyClientAccess
     */
    #[JsonProperty('third_party_client_access')]
    private ?ClientMyOrganizationThirdPartyClientAccessConfiguration $thirdPartyClientAccess;

    /**
     * @var value-of<ClientMyOrganizationDeletionBehaviorEnum> $connectionDeletionBehavior
     */
    #[JsonProperty('connection_deletion_behavior')]
    private string $connectionDeletionBehavior;

    /**
     * @var ?string $invitationLandingClientId The client ID this client uses while creating invitations through My Organization API.
     */
    #[JsonProperty('invitation_landing_client_id')]
    private ?string $invitationLandingClientId;

    /**
     * @var ?bool $enforcePermissionCeiling When true, limits the permissions that organization admins can assign to members to only those held by the admin themselves.
     */
    #[JsonProperty('enforce_permission_ceiling')]
    private ?bool $enforcePermissionCeiling;

    /**
     * @var ?bool $enforceSelfAssignmentRestriction When true, prevents organization admins from assigning permissions to themselves.
     */
    #[JsonProperty('enforce_self_assignment_restriction')]
    private ?bool $enforceSelfAssignmentRestriction;

    /**
     * @param array{
     *   allowedStrategies: array<value-of<ClientMyOrganizationConfigurationAllowedStrategiesEnum>>,
     *   connectionDeletionBehavior: value-of<ClientMyOrganizationDeletionBehaviorEnum>,
     *   connectionProfileId?: ?string,
     *   userAttributeProfileId?: ?string,
     *   thirdPartyClientAccess?: ?ClientMyOrganizationThirdPartyClientAccessConfiguration,
     *   invitationLandingClientId?: ?string,
     *   enforcePermissionCeiling?: ?bool,
     *   enforceSelfAssignmentRestriction?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionProfileId = $values['connectionProfileId'] ?? null;
        $this->userAttributeProfileId = $values['userAttributeProfileId'] ?? null;
        $this->allowedStrategies = $values['allowedStrategies'];
        $this->thirdPartyClientAccess = $values['thirdPartyClientAccess'] ?? null;
        $this->connectionDeletionBehavior = $values['connectionDeletionBehavior'];
        $this->invitationLandingClientId = $values['invitationLandingClientId'] ?? null;
        $this->enforcePermissionCeiling = $values['enforcePermissionCeiling'] ?? null;
        $this->enforceSelfAssignmentRestriction = $values['enforceSelfAssignmentRestriction'] ?? null;
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
     * @return array<value-of<ClientMyOrganizationConfigurationAllowedStrategiesEnum>>
     */
    public function getAllowedStrategies(): array
    {
        return $this->allowedStrategies;
    }

    /**
     * @param array<value-of<ClientMyOrganizationConfigurationAllowedStrategiesEnum>> $value
     */
    public function setAllowedStrategies(array $value): self
    {
        $this->allowedStrategies = $value;
        $this->_setField('allowedStrategies');
        return $this;
    }

    /**
     * @return ?ClientMyOrganizationThirdPartyClientAccessConfiguration
     */
    public function getThirdPartyClientAccess(): ?ClientMyOrganizationThirdPartyClientAccessConfiguration
    {
        return $this->thirdPartyClientAccess;
    }

    /**
     * @param ?ClientMyOrganizationThirdPartyClientAccessConfiguration $value
     */
    public function setThirdPartyClientAccess(?ClientMyOrganizationThirdPartyClientAccessConfiguration $value = null): self
    {
        $this->thirdPartyClientAccess = $value;
        $this->_setField('thirdPartyClientAccess');
        return $this;
    }

    /**
     * @return value-of<ClientMyOrganizationDeletionBehaviorEnum>
     */
    public function getConnectionDeletionBehavior(): string
    {
        return $this->connectionDeletionBehavior;
    }

    /**
     * @param value-of<ClientMyOrganizationDeletionBehaviorEnum> $value
     */
    public function setConnectionDeletionBehavior(string $value): self
    {
        $this->connectionDeletionBehavior = $value;
        $this->_setField('connectionDeletionBehavior');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
