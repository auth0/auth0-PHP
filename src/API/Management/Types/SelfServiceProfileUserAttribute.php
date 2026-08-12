<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SelfServiceProfileUserAttribute extends JsonSerializableType
{
    /**
     * @var string $name Identifier of this attribute.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var string $description Description of this attribute.
     */
    #[JsonProperty('description')]
    private string $description;

    /**
     * @var bool $isOptional Determines if this attribute is required
     */
    #[JsonProperty('is_optional')]
    private bool $isOptional;

    /**
     * @param array{
     *   name: string,
     *   description: string,
     *   isOptional: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->description = $values['description'];
        $this->isOptional = $values['isOptional'];
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
     * @return bool
     */
    public function getIsOptional(): bool
    {
        return $this->isOptional;
    }

    /**
     * @param bool $value
     */
    public function setIsOptional(bool $value): self
    {
        $this->isOptional = $value;
        $this->_setField('isOptional');
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
