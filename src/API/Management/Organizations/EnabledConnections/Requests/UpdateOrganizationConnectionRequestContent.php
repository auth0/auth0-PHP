<?php

namespace Auth0\SDK\API\Management\Organizations\EnabledConnections\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateOrganizationConnectionRequestContent extends JsonSerializableType
{
    /**
     * @var ?bool $assignMembershipOnLogin When true, all users that log in with this connection will be automatically granted membership in the organization. When false, users must be granted membership in the organization before logging in with this connection.
     */
    #[JsonProperty('assign_membership_on_login')]
    private ?bool $assignMembershipOnLogin;

    /**
     * @var ?bool $isSignupEnabled Determines whether organization signup should be enabled for this organization connection. Only applicable for database connections. Default: false.
     */
    #[JsonProperty('is_signup_enabled')]
    private ?bool $isSignupEnabled;

    /**
     * @var ?bool $showAsButton Determines whether a connection should be displayed on this organization’s login prompt. Only applicable for enterprise connections. Default: true.
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

    /**
     * @param array{
     *   assignMembershipOnLogin?: ?bool,
     *   isSignupEnabled?: ?bool,
     *   showAsButton?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->assignMembershipOnLogin = $values['assignMembershipOnLogin'] ?? null;
        $this->isSignupEnabled = $values['isSignupEnabled'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
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
}
