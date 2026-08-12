<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Password complexity options
 */
class ConnectionPasswordComplexityOptions extends JsonSerializableType
{
    /**
     * @var ?int $minLength Minimum password length
     */
    #[JsonProperty('min_length')]
    private ?int $minLength;

    /**
     * @param array{
     *   minLength?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->minLength = $values['minLength'] ?? null;
    }

    /**
     * @return ?int
     */
    public function getMinLength(): ?int
    {
        return $this->minLength;
    }

    /**
     * @param ?int $value
     */
    public function setMinLength(?int $value = null): self
    {
        $this->minLength = $value;
        $this->_setField('minLength');
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
