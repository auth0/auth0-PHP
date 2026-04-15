<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateOrganizationAllConnectionResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $organizationConnectionName Name of the connection in the scope of this organization.
     */
    #[JsonProperty('organization_connection_name')]
    private ?string $organizationConnectionName;

    /**
     * @var ?bool $assignMembershipOnLogin When true, all users that log in with this connection will be automatically granted membership in the organization. When false, users must be granted membership in the organization before logging in with this connection.
     */
    #[JsonProperty('assign_membership_on_login')]
    private ?bool $assignMembershipOnLogin;

    /**
     * @var ?bool $showAsButton Determines whether a connection should be displayed on this organization’s login prompt. Only applicable for enterprise connections. Default: true.
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

    /**
     * @var ?bool $isSignupEnabled Determines whether organization signup should be enabled for this organization connection. Only applicable for database connections. Default: false.
     */
    #[JsonProperty('is_signup_enabled')]
    private ?bool $isSignupEnabled;

    /**
     * @var ?value-of<OrganizationAccessLevelEnum> $organizationAccessLevel
     */
    #[JsonProperty('organization_access_level')]
    private ?string $organizationAccessLevel;

    /**
     * @var ?bool $isEnabled Whether the connection is enabled for the organization.
     */
    #[JsonProperty('is_enabled')]
    private ?bool $isEnabled;

    /**
     * @var string $connectionId Connection identifier.
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var ?OrganizationConnectionInformation $connection
     */
    #[JsonProperty('connection')]
    private ?OrganizationConnectionInformation $connection;

    /**
     * @param array{
     *   connectionId: string,
     *   organizationConnectionName?: ?string,
     *   assignMembershipOnLogin?: ?bool,
     *   showAsButton?: ?bool,
     *   isSignupEnabled?: ?bool,
     *   organizationAccessLevel?: ?value-of<OrganizationAccessLevelEnum>,
     *   isEnabled?: ?bool,
     *   connection?: ?OrganizationConnectionInformation,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organizationConnectionName = $values['organizationConnectionName'] ?? null;
        $this->assignMembershipOnLogin = $values['assignMembershipOnLogin'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
        $this->isSignupEnabled = $values['isSignupEnabled'] ?? null;
        $this->organizationAccessLevel = $values['organizationAccessLevel'] ?? null;
        $this->isEnabled = $values['isEnabled'] ?? null;
        $this->connectionId = $values['connectionId'];
        $this->connection = $values['connection'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getOrganizationConnectionName(): ?string
    {
        return $this->organizationConnectionName;
    }

    /**
     * @param ?string $value
     */
    public function setOrganizationConnectionName(?string $value = null): self
    {
        $this->organizationConnectionName = $value;
        $this->_setField('organizationConnectionName');
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
     * @return ?value-of<OrganizationAccessLevelEnum>
     */
    public function getOrganizationAccessLevel(): ?string
    {
        return $this->organizationAccessLevel;
    }

    /**
     * @param ?value-of<OrganizationAccessLevelEnum> $value
     */
    public function setOrganizationAccessLevel(?string $value = null): self
    {
        $this->organizationAccessLevel = $value;
        $this->_setField('organizationAccessLevel');
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
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return ?OrganizationConnectionInformation
     */
    public function getConnection(): ?OrganizationConnectionInformation
    {
        return $this->connection;
    }

    /**
     * @param ?OrganizationConnectionInformation $value
     */
    public function setConnection(?OrganizationConnectionInformation $value = null): self
    {
        $this->connection = $value;
        $this->_setField('connection');
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
