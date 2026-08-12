<?php

namespace Auth0\SDK\API\Management\Users\Permissions\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\PermissionRequestPayload;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class DeleteUserPermissionsRequestContent extends JsonSerializableType
{
    /**
     * @var array<PermissionRequestPayload> $permissions List of permissions to remove from this user.
     */
    #[JsonProperty('permissions'), ArrayType([PermissionRequestPayload::class])]
    private array $permissions;

    /**
     * @param array{
     *   permissions: array<PermissionRequestPayload>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->permissions = $values['permissions'];
    }

    /**
     * @return array<PermissionRequestPayload>
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * @param array<PermissionRequestPayload> $value
     */
    public function setPermissions(array $value): self
    {
        $this->permissions = $value;
        $this->_setField('permissions');
        return $this;
    }
}
