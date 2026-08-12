<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class OrganizationMemberEffectiveRole extends JsonSerializableType
{
    /**
     * @var string $id Role ID
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $name Role name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var string $description Role description
     */
    #[JsonProperty('description')]
    private string $description;

    /**
     * @var array<value-of<OrganizationMemberEffectiveRoleSource>> $sources Sources of the role assignment (direct or through group membership)
     */
    #[JsonProperty('sources'), ArrayType(['string'])]
    private array $sources;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   description: string,
     *   sources: array<value-of<OrganizationMemberEffectiveRoleSource>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->description = $values['description'];
        $this->sources = $values['sources'];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $value
     */
    public function setDescription(string $value): self
    {
        $this->description = $value;
        $this->_setField('description');
        return $this;
    }

    /**
     * @return array<value-of<OrganizationMemberEffectiveRoleSource>>
     */
    public function getSources(): array
    {
        return $this->sources;
    }

    /**
     * @param array<value-of<OrganizationMemberEffectiveRoleSource>> $value
     */
    public function setSources(array $value): self
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
