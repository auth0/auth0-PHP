<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class LogStreamFilter extends JsonSerializableType
{
    /**
     * @var ?value-of<LogStreamFilterTypeEnum> $type
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?value-of<LogStreamFilterGroupNameEnum> $name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @param array{
     *   type?: ?value-of<LogStreamFilterTypeEnum>,
     *   name?: ?value-of<LogStreamFilterGroupNameEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->type = $values['type'] ?? null;
        $this->name = $values['name'] ?? null;
    }

    /**
     * @return ?value-of<LogStreamFilterTypeEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<LogStreamFilterTypeEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?value-of<LogStreamFilterGroupNameEnum>
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?value-of<LogStreamFilterGroupNameEnum> $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
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
