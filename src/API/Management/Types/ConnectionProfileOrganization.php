<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The organization of the connection profile.
 */
class ConnectionProfileOrganization extends JsonSerializableType
{
    /**
     * @var ?value-of<ConnectionProfileOrganizationShowAsButtonEnum> $showAsButton
     */
    #[JsonProperty('show_as_button')]
    private ?string $showAsButton;

    /**
     * @var ?value-of<ConnectionProfileOrganizationAssignMembershipOnLoginEnum> $assignMembershipOnLogin
     */
    #[JsonProperty('assign_membership_on_login')]
    private ?string $assignMembershipOnLogin;

    /**
     * @param array{
     *   showAsButton?: ?value-of<ConnectionProfileOrganizationShowAsButtonEnum>,
     *   assignMembershipOnLogin?: ?value-of<ConnectionProfileOrganizationAssignMembershipOnLoginEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->showAsButton = $values['showAsButton'] ?? null;
        $this->assignMembershipOnLogin = $values['assignMembershipOnLogin'] ?? null;
    }

    /**
     * @return ?value-of<ConnectionProfileOrganizationShowAsButtonEnum>
     */
    public function getShowAsButton(): ?string
    {
        return $this->showAsButton;
    }

    /**
     * @param ?value-of<ConnectionProfileOrganizationShowAsButtonEnum> $value
     */
    public function setShowAsButton(?string $value = null): self
    {
        $this->showAsButton = $value;
        $this->_setField('showAsButton');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionProfileOrganizationAssignMembershipOnLoginEnum>
     */
    public function getAssignMembershipOnLogin(): ?string
    {
        return $this->assignMembershipOnLogin;
    }

    /**
     * @param ?value-of<ConnectionProfileOrganizationAssignMembershipOnLoginEnum> $value
     */
    public function setAssignMembershipOnLogin(?string $value = null): self
    {
        $this->assignMembershipOnLogin = $value;
        $this->_setField('assignMembershipOnLogin');
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
