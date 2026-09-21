<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The event content.
 */
class EventStreamCloudEventOrgConnectionUpdatedObject extends JsonSerializableType
{
    /**
     * @var EventStreamCloudEventOrgConnectionUpdatedObjectOrganization $organization
     */
    #[JsonProperty('organization')]
    private EventStreamCloudEventOrgConnectionUpdatedObjectOrganization $organization;

    /**
     * @var EventStreamCloudEventOrgConnectionUpdatedObjectConnection $connection
     */
    #[JsonProperty('connection')]
    private EventStreamCloudEventOrgConnectionUpdatedObjectConnection $connection;

    /**
     * When true, all users that log in with this connection will be automatically granted membership
     * in the organization. When false, users must be granted membership in the organization before
     * logging in with this connection.
     *
     * @var ?bool $assignMembershipOnLogin
     */
    #[JsonProperty('assign_membership_on_login')]
    private ?bool $assignMembershipOnLogin;

    /**
     * Determines whether a connection should be displayed on this organization’s login prompt.
     * Only applicable for enterprise connections.
     *
     * @var ?bool $showAsButton
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

    /**
     * Determines whether organization signup should be enabled for this organization connection.
     * Only applicable for database connections.
     *
     * @var ?bool $isSignupEnabled
     */
    #[JsonProperty('is_signup_enabled')]
    private ?bool $isSignupEnabled;

    /**
     * @var ?bool $isEnabled Determines whether the connection is enabled for the organization.
     */
    #[JsonProperty('is_enabled')]
    private ?bool $isEnabled;

    /**
     * @var (
     *    value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel0Enum>
     *   |value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel1Enum>
     *   |value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel2Enum>
     *   |value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel3Enum>
     * )|null $organizationAccessLevel
     */
    #[JsonProperty('organization_access_level'), Union('string', 'null')]
    private string|null $organizationAccessLevel;

    /**
     * @param array{
     *   organization: EventStreamCloudEventOrgConnectionUpdatedObjectOrganization,
     *   connection: EventStreamCloudEventOrgConnectionUpdatedObjectConnection,
     *   assignMembershipOnLogin?: ?bool,
     *   showAsButton?: ?bool,
     *   isSignupEnabled?: ?bool,
     *   isEnabled?: ?bool,
     *   organizationAccessLevel?: (
     *    value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel0Enum>
     *   |value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel1Enum>
     *   |value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel2Enum>
     *   |value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel3Enum>
     * )|null,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organization = $values['organization'];
        $this->connection = $values['connection'];
        $this->assignMembershipOnLogin = $values['assignMembershipOnLogin'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
        $this->isSignupEnabled = $values['isSignupEnabled'] ?? null;
        $this->isEnabled = $values['isEnabled'] ?? null;
        $this->organizationAccessLevel = $values['organizationAccessLevel'] ?? null;
    }

    /**
     * @return EventStreamCloudEventOrgConnectionUpdatedObjectOrganization
     */
    public function getOrganization(): EventStreamCloudEventOrgConnectionUpdatedObjectOrganization
    {
        return $this->organization;
    }

    /**
     * @param EventStreamCloudEventOrgConnectionUpdatedObjectOrganization $value
     */
    public function setOrganization(EventStreamCloudEventOrgConnectionUpdatedObjectOrganization $value): self
    {
        $this->organization = $value;
        $this->_setField('organization');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgConnectionUpdatedObjectConnection
     */
    public function getConnection(): EventStreamCloudEventOrgConnectionUpdatedObjectConnection
    {
        return $this->connection;
    }

    /**
     * @param EventStreamCloudEventOrgConnectionUpdatedObjectConnection $value
     */
    public function setConnection(EventStreamCloudEventOrgConnectionUpdatedObjectConnection $value): self
    {
        $this->connection = $value;
        $this->_setField('connection');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAssignMembershipOnLogin(): ?bool
    {
        return $this->assignMembershipOnLogin;
    }

    /**
     * @param ?bool $value
     */
    public function setAssignMembershipOnLogin(?bool $value = null): self
    {
        $this->assignMembershipOnLogin = $value;
        $this->_setField('assignMembershipOnLogin');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getShowAsButton(): ?bool
    {
        return $this->showAsButton;
    }

    /**
     * @param ?bool $value
     */
    public function setShowAsButton(?bool $value = null): self
    {
        $this->showAsButton = $value;
        $this->_setField('showAsButton');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsSignupEnabled(): ?bool
    {
        return $this->isSignupEnabled;
    }

    /**
     * @param ?bool $value
     */
    public function setIsSignupEnabled(?bool $value = null): self
    {
        $this->isSignupEnabled = $value;
        $this->_setField('isSignupEnabled');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    /**
     * @param ?bool $value
     */
    public function setIsEnabled(?bool $value = null): self
    {
        $this->isEnabled = $value;
        $this->_setField('isEnabled');
        return $this;
    }

    /**
     * @return (
     *    value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel0Enum>
     *   |value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel1Enum>
     *   |value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel2Enum>
     *   |value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel3Enum>
     * )|null
     */
    public function getOrganizationAccessLevel(): string|null
    {
        return $this->organizationAccessLevel;
    }

    /**
     * @param (
     *    value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel0Enum>
     *   |value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel1Enum>
     *   |value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel2Enum>
     *   |value-of<EventStreamCloudEventOrgConnectionUpdatedObjectOrganizationAccessLevel3Enum>
     * )|null $value
     */
    public function setOrganizationAccessLevel(string|null $value = null): self
    {
        $this->organizationAccessLevel = $value;
        $this->_setField('organizationAccessLevel');
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
