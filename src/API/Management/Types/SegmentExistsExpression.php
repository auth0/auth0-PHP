<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SegmentExistsExpression extends JsonSerializableType
{
    /**
     * @var bool $exists
     */
    #[JsonProperty('exists')]
    private bool $exists;

    /**
     * @param array{
     *   exists: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->exists = $values['exists'];
    }

    /**
     * @return bool
     */
    public function getExists(): bool
    {
        return $this->exists;
    }

    /**
     * @param bool $value
     */
    public function setExists(bool $value): self
    {
        $this->exists = $value;
        $this->_setField('exists');
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
