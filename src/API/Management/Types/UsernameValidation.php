<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UsernameValidation extends JsonSerializableType
{
    /**
     * @var ?float $minLength Minimum allowed length
     */
    #[JsonProperty('min_length')]
    private ?float $minLength;

    /**
     * @var ?float $maxLength Maximum allowed length
     */
    #[JsonProperty('max_length')]
    private ?float $maxLength;

    /**
     * @var ?UsernameAllowedTypes $allowedTypes
     */
    #[JsonProperty('allowed_types')]
    private ?UsernameAllowedTypes $allowedTypes;

    /**
     * @param array{
     *   minLength?: ?float,
     *   maxLength?: ?float,
     *   allowedTypes?: ?UsernameAllowedTypes,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->minLength = $values['minLength'] ?? null;
        $this->maxLength = $values['maxLength'] ?? null;
        $this->allowedTypes = $values['allowedTypes'] ?? null;
    }

    /**
     * @return ?float
     */
    public function getMinLength(): ?float
    {
        return $this->minLength;
    }

    /**
     * @param ?float $value
     */
    public function setMinLength(?float $value = null): self
    {
        $this->minLength = $value;
        $this->_setField('minLength');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getMaxLength(): ?float
    {
        return $this->maxLength;
    }

    /**
     * @param ?float $value
     */
    public function setMaxLength(?float $value = null): self
    {
        $this->maxLength = $value;
        $this->_setField('maxLength');
        return $this;
    }

    /**
     * @return ?UsernameAllowedTypes
     */
    public function getAllowedTypes(): ?UsernameAllowedTypes
    {
        return $this->allowedTypes;
    }

    /**
     * @param ?UsernameAllowedTypes $value
     */
    public function setAllowedTypes(?UsernameAllowedTypes $value = null): self
    {
        $this->allowedTypes = $value;
        $this->_setField('allowedTypes');
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
