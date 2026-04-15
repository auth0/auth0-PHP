<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldFileConfigStorage extends JsonSerializableType
{
    /**
     * @var value-of<FormFieldFileConfigStorageTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @param array{
     *   type: value-of<FormFieldFileConfigStorageTypeEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
    }

    /**
     * @return value-of<FormFieldFileConfigStorageTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FormFieldFileConfigStorageTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
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
