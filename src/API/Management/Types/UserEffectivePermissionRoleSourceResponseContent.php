<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UserEffectivePermissionRoleSourceResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id ID for this role.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name Name of this role.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $description Description of this role.
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?array<value-of<UserEffectivePermissionRoleSourceEnum>> $sources List of sources where this role is coming from.
     */
    #[JsonProperty('sources'), ArrayType(['string'])]
    private ?array $sources;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   description?: ?string,
     *   sources?: ?array<value-of<UserEffectivePermissionRoleSourceEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->sources = $values['sources'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
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
     * @return ?array<value-of<UserEffectivePermissionRoleSourceEnum>>
     */
    public function getSources(): ?array
    {
        return $this->sources;
    }

    /**
     * @param ?array<value-of<UserEffectivePermissionRoleSourceEnum>> $value
     */
    public function setSources(?array $value = null): self
    {
        $this->sources = $value;
        $this->_setField('sources');
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
