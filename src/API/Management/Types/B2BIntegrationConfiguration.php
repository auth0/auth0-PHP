<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Configuration for B2B Integration clients.
 */
class B2BIntegrationConfiguration extends JsonSerializableType
{
    /**
     * @var ?array<string> $ssoProfiles List of SSO profile IDs linked to this B2B integration client. Maximum 1 entry.
     */
    #[JsonProperty('sso_profiles'), ArrayType(['string'])]
    private ?array $ssoProfiles;

    /**
     * @var ?value-of<B2BIntegrationConfigurationIntegrationTypeEnum> $integrationType
     */
    #[JsonProperty('integration_type')]
    private ?string $integrationType;

    /**
     * @param array{
     *   ssoProfiles?: ?array<string>,
     *   integrationType?: ?value-of<B2BIntegrationConfigurationIntegrationTypeEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->ssoProfiles = $values['ssoProfiles'] ?? null;
        $this->integrationType = $values['integrationType'] ?? null;
    }

    /**
     * @return ?array<string>
     */
    public function getSsoProfiles(): ?array
    {
        return $this->ssoProfiles;
    }

    /**
     * @param ?array<string> $value
     */
    public function setSsoProfiles(?array $value = null): self
    {
        $this->ssoProfiles = $value;
        $this->_setField('ssoProfiles');
        return $this;
    }

    /**
     * @return ?value-of<B2BIntegrationConfigurationIntegrationTypeEnum>
     */
    public function getIntegrationType(): ?string
    {
        return $this->integrationType;
    }

    /**
     * @param ?value-of<B2BIntegrationConfigurationIntegrationTypeEnum> $value
     */
    public function setIntegrationType(?string $value = null): self
    {
        $this->integrationType = $value;
        $this->_setField('integrationType');
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
