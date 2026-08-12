<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Validation result for the Client ID Metadata Document
 */
class CimdValidationResult extends JsonSerializableType
{
    /**
     * @var bool $valid Whether the metadata document passed validation
     */
    #[JsonProperty('valid')]
    private bool $valid;

    /**
     * @var array<string> $violations Array of validation violation messages (if any)
     */
    #[JsonProperty('violations'), ArrayType(['string'])]
    private array $violations;

    /**
     * @var array<string> $warnings Array of warning messages (if any)
     */
    #[JsonProperty('warnings'), ArrayType(['string'])]
    private array $warnings;

    /**
     * @param array{
     *   valid: bool,
     *   violations: array<string>,
     *   warnings: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->valid = $values['valid'];
        $this->violations = $values['violations'];
        $this->warnings = $values['warnings'];
    }

    /**
     * @return bool
     */
    public function getValid(): bool
    {
        return $this->valid;
    }

    /**
     * @param bool $value
     */
    public function setValid(bool $value): self
    {
        $this->valid = $value;
        $this->_setField('valid');
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getViolations(): array
    {
        return $this->violations;
    }

    /**
     * @param array<string> $value
     */
    public function setViolations(array $value): self
    {
        $this->violations = $value;
        $this->_setField('violations');
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getWarnings(): array
    {
        return $this->warnings;
    }

    /**
     * @param array<string> $value
     */
    public function setWarnings(array $value): self
    {
        $this->warnings = $value;
        $this->_setField('warnings');
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
