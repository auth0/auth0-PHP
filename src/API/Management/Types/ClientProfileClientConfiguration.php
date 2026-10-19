<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Runtime policy applied to matched clients. Omitted fields fall back to each client's own setting.
 */
class ClientProfileClientConfiguration extends JsonSerializableType
{
    /**
     * @var ?ClientProfileClientConfigurationRefreshToken $refreshToken
     */
    #[JsonProperty('refresh_token')]
    private ?ClientProfileClientConfigurationRefreshToken $refreshToken;

    /**
     * @var ?ClientProfileClientConfigurationOrganizationUsage $organizationUsage
     */
    #[JsonProperty('organization_usage')]
    private ?ClientProfileClientConfigurationOrganizationUsage $organizationUsage;

    /**
     * @var ?ClientProfileClientConfigurationOrganizationRequireBehavior $organizationRequireBehavior
     */
    #[JsonProperty('organization_require_behavior')]
    private ?ClientProfileClientConfigurationOrganizationRequireBehavior $organizationRequireBehavior;

    /**
     * @var ?ClientProfileClientConfigurationOrganizationDiscoveryMethods $organizationDiscoveryMethods
     */
    #[JsonProperty('organization_discovery_methods')]
    private ?ClientProfileClientConfigurationOrganizationDiscoveryMethods $organizationDiscoveryMethods;

    /**
     * @var ?ClientProfileClientConfigurationRequireProofOfPossession $requireProofOfPossession
     */
    #[JsonProperty('require_proof_of_possession')]
    private ?ClientProfileClientConfigurationRequireProofOfPossession $requireProofOfPossession;

    /**
     * @param array{
     *   refreshToken?: ?ClientProfileClientConfigurationRefreshToken,
     *   organizationUsage?: ?ClientProfileClientConfigurationOrganizationUsage,
     *   organizationRequireBehavior?: ?ClientProfileClientConfigurationOrganizationRequireBehavior,
     *   organizationDiscoveryMethods?: ?ClientProfileClientConfigurationOrganizationDiscoveryMethods,
     *   requireProofOfPossession?: ?ClientProfileClientConfigurationRequireProofOfPossession,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->refreshToken = $values['refreshToken'] ?? null;
        $this->organizationUsage = $values['organizationUsage'] ?? null;
        $this->organizationRequireBehavior = $values['organizationRequireBehavior'] ?? null;
        $this->organizationDiscoveryMethods = $values['organizationDiscoveryMethods'] ?? null;
        $this->requireProofOfPossession = $values['requireProofOfPossession'] ?? null;
    }

    /**
     * @return ?ClientProfileClientConfigurationRefreshToken
     */
    public function getRefreshToken(): ?ClientProfileClientConfigurationRefreshToken
    {
        return $this->refreshToken;
    }

    /**
     * @param ?ClientProfileClientConfigurationRefreshToken $value
     */
    public function setRefreshToken(?ClientProfileClientConfigurationRefreshToken $value = null): self
    {
        $this->refreshToken = $value;
        $this->_setField('refreshToken');
        return $this;
    }

    /**
     * @return ?ClientProfileClientConfigurationOrganizationUsage
     */
    public function getOrganizationUsage(): ?ClientProfileClientConfigurationOrganizationUsage
    {
        return $this->organizationUsage;
    }

    /**
     * @param ?ClientProfileClientConfigurationOrganizationUsage $value
     */
    public function setOrganizationUsage(?ClientProfileClientConfigurationOrganizationUsage $value = null): self
    {
        $this->organizationUsage = $value;
        $this->_setField('organizationUsage');
        return $this;
    }

    /**
     * @return ?ClientProfileClientConfigurationOrganizationRequireBehavior
     */
    public function getOrganizationRequireBehavior(): ?ClientProfileClientConfigurationOrganizationRequireBehavior
    {
        return $this->organizationRequireBehavior;
    }

    /**
     * @param ?ClientProfileClientConfigurationOrganizationRequireBehavior $value
     */
    public function setOrganizationRequireBehavior(?ClientProfileClientConfigurationOrganizationRequireBehavior $value = null): self
    {
        $this->organizationRequireBehavior = $value;
        $this->_setField('organizationRequireBehavior');
        return $this;
    }

    /**
     * @return ?ClientProfileClientConfigurationOrganizationDiscoveryMethods
     */
    public function getOrganizationDiscoveryMethods(): ?ClientProfileClientConfigurationOrganizationDiscoveryMethods
    {
        return $this->organizationDiscoveryMethods;
    }

    /**
     * @param ?ClientProfileClientConfigurationOrganizationDiscoveryMethods $value
     */
    public function setOrganizationDiscoveryMethods(?ClientProfileClientConfigurationOrganizationDiscoveryMethods $value = null): self
    {
        $this->organizationDiscoveryMethods = $value;
        $this->_setField('organizationDiscoveryMethods');
        return $this;
    }

    /**
     * @return ?ClientProfileClientConfigurationRequireProofOfPossession
     */
    public function getRequireProofOfPossession(): ?ClientProfileClientConfigurationRequireProofOfPossession
    {
        return $this->requireProofOfPossession;
    }

    /**
     * @param ?ClientProfileClientConfigurationRequireProofOfPossession $value
     */
    public function setRequireProofOfPossession(?ClientProfileClientConfigurationRequireProofOfPossession $value = null): self
    {
        $this->requireProofOfPossession = $value;
        $this->_setField('requireProofOfPossession');
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
