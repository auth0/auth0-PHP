<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Settings for SAML assertion decryption.
 */
class ConnectionAssertionDecryptionSettings extends JsonSerializableType
{
    /**
     * @var value-of<ConnectionAssertionDecryptionAlgorithmProfileEnum> $algorithmProfile
     */
    #[JsonProperty('algorithm_profile')]
    private string $algorithmProfile;

    /**
     * @var ?array<string> $algorithmExceptions A list of insecure algorithms to allow for SAML assertion decryption.
     */
    #[JsonProperty('algorithm_exceptions'), ArrayType(['string'])]
    private ?array $algorithmExceptions;

    /**
     * @param array{
     *   algorithmProfile: value-of<ConnectionAssertionDecryptionAlgorithmProfileEnum>,
     *   algorithmExceptions?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->algorithmProfile = $values['algorithmProfile'];
        $this->algorithmExceptions = $values['algorithmExceptions'] ?? null;
    }

    /**
     * @return value-of<ConnectionAssertionDecryptionAlgorithmProfileEnum>
     */
    public function getAlgorithmProfile(): string
    {
        return $this->algorithmProfile;
    }

    /**
     * @param value-of<ConnectionAssertionDecryptionAlgorithmProfileEnum> $value
     */
    public function setAlgorithmProfile(string $value): self
    {
        $this->algorithmProfile = $value;
        $this->_setField('algorithmProfile');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getAlgorithmExceptions(): ?array
    {
        return $this->algorithmExceptions;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAlgorithmExceptions(?array $value = null): self
    {
        $this->algorithmExceptions = $value;
        $this->_setField('algorithmExceptions');
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
