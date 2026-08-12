<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Proof-of-Possession configuration for access tokens
 */
class ResourceServerProofOfPossession extends JsonSerializableType
{
    /**
     * @var value-of<ResourceServerProofOfPossessionMechanismEnum> $mechanism
     */
    #[JsonProperty('mechanism')]
    private string $mechanism;

    /**
     * @var bool $required Whether the use of Proof-of-Possession is required for the resource server
     */
    #[JsonProperty('required')]
    private bool $required;

    /**
     * @var ?value-of<ResourceServerProofOfPossessionRequiredForEnum> $requiredFor
     */
    #[JsonProperty('required_for')]
    private ?string $requiredFor;

    /**
     * @param array{
     *   mechanism: value-of<ResourceServerProofOfPossessionMechanismEnum>,
     *   required: bool,
     *   requiredFor?: ?value-of<ResourceServerProofOfPossessionRequiredForEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->mechanism = $values['mechanism'];
        $this->required = $values['required'];
        $this->requiredFor = $values['requiredFor'] ?? null;
    }

    /**
     * @return value-of<ResourceServerProofOfPossessionMechanismEnum>
     */
    public function getMechanism(): string
    {
        return $this->mechanism;
    }

    /**
     * @param value-of<ResourceServerProofOfPossessionMechanismEnum> $value
     */
    public function setMechanism(string $value): self
    {
        $this->mechanism = $value;
        $this->_setField('mechanism');
        return $this;
    }

    /**
     * @return bool
     */
    public function getRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $value
     */
    public function setRequired(bool $value): self
    {
        $this->required = $value;
        $this->_setField('required');
        return $this;
    }

    /**
     * @return ?value-of<ResourceServerProofOfPossessionRequiredForEnum>
     */
    public function getRequiredFor(): ?string
    {
        return $this->requiredFor;
    }

    /**
     * @param ?value-of<ResourceServerProofOfPossessionRequiredForEnum> $value
     */
    public function setRequiredFor(?string $value = null): self
    {
        $this->requiredFor = $value;
        $this->_setField('requiredFor');
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
