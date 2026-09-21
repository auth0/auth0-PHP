<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Settings for SAML assertion decryption.
 */
class EventStreamCloudEventConnectionDeletedPreviousObject2OptionsAssertionDecryptionSettings extends JsonSerializableType
{
    /**
     * @var ?array<string> $algorithmExceptions A list of insecure algorithms to allow for SAML assertion decryption.
     */
    #[JsonProperty('algorithm_exceptions'), ArrayType(['string'])]
    private ?array $algorithmExceptions;

    /**
     * @var value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsAssertionDecryptionSettingsAlgorithmProfileEnum> $algorithmProfile
     */
    #[JsonProperty('algorithm_profile')]
    private string $algorithmProfile;

    /**
     * @param array{
     *   algorithmProfile: value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsAssertionDecryptionSettingsAlgorithmProfileEnum>,
     *   algorithmExceptions?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->algorithmExceptions = $values['algorithmExceptions'] ?? null;
        $this->algorithmProfile = $values['algorithmProfile'];
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
     * @return value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsAssertionDecryptionSettingsAlgorithmProfileEnum>
     */
    public function getAlgorithmProfile(): string
    {
        return $this->algorithmProfile;
    }

    /**
     * @param value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsAssertionDecryptionSettingsAlgorithmProfileEnum> $value
     */
    public function setAlgorithmProfile(string $value): self
    {
        $this->algorithmProfile = $value;
        $this->_setField('algorithmProfile');
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
