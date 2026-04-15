<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GetSettingsResponseContent extends JsonSerializableType
{
    /**
     * @var ?value-of<UniversalLoginExperienceEnum> $universalLoginExperience
     */
    #[JsonProperty('universal_login_experience')]
    private ?string $universalLoginExperience;

    /**
     * @var ?bool $identifierFirst Whether identifier first is enabled or not
     */
    #[JsonProperty('identifier_first')]
    private ?bool $identifierFirst;

    /**
     * @var ?bool $webauthnPlatformFirstFactor Use WebAuthn with Device Biometrics as the first authentication factor
     */
    #[JsonProperty('webauthn_platform_first_factor')]
    private ?bool $webauthnPlatformFirstFactor;

    /**
     * @param array{
     *   universalLoginExperience?: ?value-of<UniversalLoginExperienceEnum>,
     *   identifierFirst?: ?bool,
     *   webauthnPlatformFirstFactor?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->universalLoginExperience = $values['universalLoginExperience'] ?? null;
        $this->identifierFirst = $values['identifierFirst'] ?? null;
        $this->webauthnPlatformFirstFactor = $values['webauthnPlatformFirstFactor'] ?? null;
    }

    /**
     * @return ?value-of<UniversalLoginExperienceEnum>
     */
    public function getUniversalLoginExperience(): ?string
    {
        return $this->universalLoginExperience;
    }

    /**
     * @param ?value-of<UniversalLoginExperienceEnum> $value
     */
    public function setUniversalLoginExperience(?string $value = null): self
    {
        $this->universalLoginExperience = $value;
        $this->_setField('universalLoginExperience');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIdentifierFirst(): ?bool
    {
        return $this->identifierFirst;
    }

    /**
     * @param ?bool $value
     */
    public function setIdentifierFirst(?bool $value = null): self
    {
        $this->identifierFirst = $value;
        $this->_setField('identifierFirst');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getWebauthnPlatformFirstFactor(): ?bool
    {
        return $this->webauthnPlatformFirstFactor;
    }

    /**
     * @param ?bool $value
     */
    public function setWebauthnPlatformFirstFactor(?bool $value = null): self
    {
        $this->webauthnPlatformFirstFactor = $value;
        $this->_setField('webauthnPlatformFirstFactor');
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
