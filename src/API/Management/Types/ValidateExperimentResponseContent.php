<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ValidateExperimentResponseContent extends JsonSerializableType
{
    /**
     * @var bool $isValid Whether the experiment is ready to be activated.
     */
    #[JsonProperty('is_valid')]
    private bool $isValid;

    /**
     * @var array<ExperimentValidationError> $errors List of validation errors preventing activation. Empty when is_valid is true.
     */
    #[JsonProperty('errors'), ArrayType([ExperimentValidationError::class])]
    private array $errors;

    /**
     * @param array{
     *   isValid: bool,
     *   errors: array<ExperimentValidationError>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->isValid = $values['isValid'];
        $this->errors = $values['errors'];
    }

    /**
     * @return bool
     */
    public function getIsValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @param bool $value
     */
    public function setIsValid(bool $value): self
    {
        $this->isValid = $value;
        $this->_setField('isValid');
        return $this;
    }

    /**
     * @return array<ExperimentValidationError>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array<ExperimentValidationError> $value
     */
    public function setErrors(array $value): self
    {
        $this->errors = $value;
        $this->_setField('errors');
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
