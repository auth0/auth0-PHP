<?php

namespace Auth0\SDK\API\Management\Roles\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

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
     * @param array{
     *   name: string,
     *   description?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
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
}
