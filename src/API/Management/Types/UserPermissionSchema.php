<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UserPermissionSchema extends JsonSerializableType
{
    /**
     * @var ?string $resourceServerIdentifier Resource server (API) identifier that this permission is for.
     */
    #[JsonProperty('resource_server_identifier')]
    private ?string $resourceServerIdentifier;

    /**
     * @var ?string $permissionName Name of this permission.
     */
    #[JsonProperty('permission_name')]
    private ?string $permissionName;

    /**
     * @var ?string $resourceServerName Resource server (API) name this permission is for.
     */
    #[JsonProperty('resource_server_name')]
    private ?string $resourceServerName;

    /**
     * @var ?string $description Description of this permission.
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @param array{
     *   resourceServerIdentifier?: ?string,
     *   permissionName?: ?string,
     *   resourceServerName?: ?string,
     *   description?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->resourceServerIdentifier = $values['resourceServerIdentifier'] ?? null;
        $this->permissionName = $values['permissionName'] ?? null;
        $this->resourceServerName = $values['resourceServerName'] ?? null;
        $this->description = $values['description'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getResourceServerIdentifier(): ?string
    {
        return $this->resourceServerIdentifier;
    }

    /**
     * @param ?string $value
     */
    public function setResourceServerIdentifier(?string $value = null): self
    {
        $this->resourceServerIdentifier = $value;
        $this->_setField('resourceServerIdentifier');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPermissionName(): ?string
    {
        return $this->permissionName;
    }

    /**
     * @param ?string $value
     */
    public function setPermissionName(?string $value = null): self
    {
        $this->permissionName = $value;
        $this->_setField('permissionName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getResourceServerName(): ?string
    {
        return $this->resourceServerName;
    }

    /**
     * @param ?string $value
     */
    public function setResourceServerName(?string $value = null): self
    {
        $this->resourceServerName = $value;
        $this->_setField('resourceServerName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $value
     */
    public function setDescription(?string $value = null): self
    {
        $this->description = $value;
        $this->_setField('description');
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
