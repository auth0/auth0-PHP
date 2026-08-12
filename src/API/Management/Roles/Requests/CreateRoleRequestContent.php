<?php

namespace Auth0\SDK\API\Management\Roles\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\RoleTypeEnum;

class CreateRoleRequestContent extends JsonSerializableType
{
    /**
     * @var string $name Name of the role.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $description Description of the role.
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?value-of<RoleTypeEnum> $type The type of the role. Defaults to tenant.
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?string $ownerId The ID of the organization that owns this role. Required when type is "organization".
     */
    #[JsonProperty('owner_id')]
    private ?string $ownerId;

    /**
     * @param array{
     *   name: string,
     *   description?: ?string,
     *   type?: ?value-of<RoleTypeEnum>,
     *   ownerId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->ownerId = $values['ownerId'] ?? null;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
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
     * @return ?value-of<RoleTypeEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<RoleTypeEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getOwnerId(): ?string
    {
        return $this->ownerId;
    }

    /**
     * @param ?string $value
     */
    public function setOwnerId(?string $value = null): self
    {
        $this->ownerId = $value;
        $this->_setField('ownerId');
        return $this;
    }
}
