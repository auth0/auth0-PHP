<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FormMessages extends JsonSerializableType
{
    /**
     * @var ?array<string, string> $errors
     */
    #[JsonProperty('errors'), ArrayType(['string' => 'string'])]
    private ?array $errors;

    /**
     * @var ?array<string, string> $custom
     */
    #[JsonProperty('custom'), ArrayType(['string' => 'string'])]
    private ?array $custom;

    /**
     * @param array{
     *   errors?: ?array<string, string>,
     *   custom?: ?array<string, string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->errors = $values['errors'] ?? null;
        $this->custom = $values['custom'] ?? null;
    }

    /**
     * @return ?array<string, string>
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * @param ?array<string, string> $value
     */
    public function setErrors(?array $value = null): self
    {
        $this->errors = $value;
        $this->_setField('errors');
        return $this;
    }

    /**
     * @return ?array<string, string>
     */
    public function getCustom(): ?array
    {
        return $this->custom;
    }

    /**
     * @param ?array<string, string> $value
     */
    public function setCustom(?array $value = null): self
    {
        $this->custom = $value;
        $this->_setField('custom');
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
