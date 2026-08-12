<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PermissionRequestPayload extends JsonSerializableType
{
    /**
     * @var string $resourceServerIdentifier Resource server (API) identifier that this permission is for.
     */
    #[JsonProperty('resource_server_identifier')]
    private string $resourceServerIdentifier;

    /**
     * @var string $permissionName Name of this permission.
     */
    #[JsonProperty('permission_name')]
    private string $permissionName;

    /**
     * @param array{
     *   resourceServerIdentifier: string,
     *   permissionName: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->resourceServerIdentifier = $values['resourceServerIdentifier'];
        $this->permissionName = $values['permissionName'];
    }

    /**
     * @return string
     */
    public function getResourceServerIdentifier(): string
    {
        return $this->resourceServerIdentifier;
    }

    /**
     * @param string $value
     */
    public function setResourceServerIdentifier(string $value): self
    {
        $this->resourceServerIdentifier = $value;
        $this->_setField('resourceServerIdentifier');
        return $this;
    }

    /**
     * @return string
     */
    public function getPermissionName(): string
    {
        return $this->permissionName;
    }

    /**
     * @param string $value
     */
    public function setPermissionName(string $value): self
    {
        $this->permissionName = $value;
        $this->_setField('permissionName');
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
