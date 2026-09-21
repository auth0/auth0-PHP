<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * A role visibility override.
 */
class OrganizationTemplateRoleVisibilityOverride extends JsonSerializableType
{
    /**
     * @var string $roleId The role identifier.
     */
    #[JsonProperty('role_id')]
    private string $roleId;

    /**
     * @var value-of<OrganizationTemplateRoleVisibilityEnum> $access
     */
    #[JsonProperty('access')]
    private string $access;

    /**
     * @param array{
     *   roleId: string,
     *   access: value-of<OrganizationTemplateRoleVisibilityEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->roleId = $values['roleId'];
        $this->access = $values['access'];
    }

    /**
     * @return string
     */
    public function getRoleId(): string
    {
        return $this->roleId;
    }

    /**
     * @param string $value
     */
    public function setRoleId(string $value): self
    {
        $this->roleId = $value;
        $this->_setField('roleId');
        return $this;
    }

    /**
     * @return value-of<OrganizationTemplateRoleVisibilityEnum>
     */
    public function getAccess(): string
    {
        return $this->access;
    }

    /**
     * @param value-of<OrganizationTemplateRoleVisibilityEnum> $value
     */
    public function setAccess(string $value): self
    {
        $this->access = $value;
        $this->_setField('access');
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
