<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Password complexity requirements configuration
 */
class ConnectionPasswordOptionsComplexity extends JsonSerializableType
{
    /**
     * @var ?int $minLength Minimum password length required (1-72 characters)
     */
    #[JsonProperty('min_length')]
    private ?int $minLength;

    /**
     * @var ?array<value-of<PasswordCharacterTypeEnum>> $characterTypes Required character types that must be present in passwords. Valid options: uppercase, lowercase, number, special
     */
    #[JsonProperty('character_types'), ArrayType(['string'])]
    private ?array $characterTypes;

    /**
     * @var ?value-of<PasswordCharacterTypeRulePolicyEnum> $characterTypeRule
     */
    #[JsonProperty('character_type_rule')]
    private ?string $characterTypeRule;

    /**
     * @var ?value-of<PasswordIdenticalCharactersPolicyEnum> $identicalCharacters
     */
    #[JsonProperty('identical_characters')]
    private ?string $identicalCharacters;

    /**
     * @var ?value-of<PasswordSequentialCharactersPolicyEnum> $sequentialCharacters
     */
    #[JsonProperty('sequential_characters')]
    private ?string $sequentialCharacters;

    /**
     * @var ?value-of<PasswordMaxLengthExceededPolicyEnum> $maxLengthExceeded
     */
    #[JsonProperty('max_length_exceeded')]
    private ?string $maxLengthExceeded;

    /**
     * @param array{
     *   minLength?: ?int,
     *   characterTypes?: ?array<value-of<PasswordCharacterTypeEnum>>,
     *   characterTypeRule?: ?value-of<PasswordCharacterTypeRulePolicyEnum>,
     *   identicalCharacters?: ?value-of<PasswordIdenticalCharactersPolicyEnum>,
     *   sequentialCharacters?: ?value-of<PasswordSequentialCharactersPolicyEnum>,
     *   maxLengthExceeded?: ?value-of<PasswordMaxLengthExceededPolicyEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->minLength = $values['minLength'] ?? null;
        $this->characterTypes = $values['characterTypes'] ?? null;
        $this->characterTypeRule = $values['characterTypeRule'] ?? null;
        $this->identicalCharacters = $values['identicalCharacters'] ?? null;
        $this->sequentialCharacters = $values['sequentialCharacters'] ?? null;
        $this->maxLengthExceeded = $values['maxLengthExceeded'] ?? null;
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
     * @return ?array<value-of<PasswordCharacterTypeEnum>>
     */
    public function getCharacterTypes(): ?array
    {
        return $this->characterTypes;
    }

    /**
     * @param ?array<value-of<PasswordCharacterTypeEnum>> $value
     */
    public function setCharacterTypes(?array $value = null): self
    {
        $this->characterTypes = $value;
        $this->_setField('characterTypes');
        return $this;
    }

    /**
     * @return ?value-of<PasswordCharacterTypeRulePolicyEnum>
     */
    public function getCharacterTypeRule(): ?string
    {
        return $this->characterTypeRule;
    }

    /**
     * @param ?value-of<PasswordCharacterTypeRulePolicyEnum> $value
     */
    public function setCharacterTypeRule(?string $value = null): self
    {
        $this->characterTypeRule = $value;
        $this->_setField('characterTypeRule');
        return $this;
    }

    /**
     * @return ?value-of<PasswordIdenticalCharactersPolicyEnum>
     */
    public function getIdenticalCharacters(): ?string
    {
        return $this->identicalCharacters;
    }

    /**
     * @param ?value-of<PasswordIdenticalCharactersPolicyEnum> $value
     */
    public function setIdenticalCharacters(?string $value = null): self
    {
        $this->identicalCharacters = $value;
        $this->_setField('identicalCharacters');
        return $this;
    }

    /**
     * @return ?value-of<PasswordSequentialCharactersPolicyEnum>
     */
    public function getSequentialCharacters(): ?string
    {
        return $this->sequentialCharacters;
    }

    /**
     * @param ?value-of<PasswordSequentialCharactersPolicyEnum> $value
     */
    public function setSequentialCharacters(?string $value = null): self
    {
        $this->sequentialCharacters = $value;
        $this->_setField('sequentialCharacters');
        return $this;
    }

    /**
     * @return ?value-of<PasswordMaxLengthExceededPolicyEnum>
     */
    public function getMaxLengthExceeded(): ?string
    {
        return $this->maxLengthExceeded;
    }

    /**
     * @param ?value-of<PasswordMaxLengthExceededPolicyEnum> $value
     */
    public function setMaxLengthExceeded(?string $value = null): self
    {
        $this->maxLengthExceeded = $value;
        $this->_setField('maxLengthExceeded');
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
