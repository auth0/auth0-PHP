<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class AddOrganizationConnectionResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $connectionId ID of the connection.
     */
    #[JsonProperty('connection_id')]
    private ?string $connectionId;

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
     * @var ?OrganizationConnectionInformation $connection
     */
    #[JsonProperty('connection')]
    private ?OrganizationConnectionInformation $connection;

    /**
     * @param array{
     *   connectionId?: ?string,
     *   assignMembershipOnLogin?: ?bool,
     *   showAsButton?: ?bool,
     *   isSignupEnabled?: ?bool,
     *   connection?: ?OrganizationConnectionInformation,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->connectionId = $values['connectionId'] ?? null;
        $this->assignMembershipOnLogin = $values['assignMembershipOnLogin'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
        $this->isSignupEnabled = $values['isSignupEnabled'] ?? null;
        $this->connection = $values['connection'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getConnectionId(): ?string
    {
        return $this->connectionId;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionId(?string $value = null): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
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
