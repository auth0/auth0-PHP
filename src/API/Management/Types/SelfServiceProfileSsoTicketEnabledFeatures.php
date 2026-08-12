<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Specifies which features are enabled for an "edit connection" ticket. Only applicable when connection ID is provided.
 */
class SelfServiceProfileSsoTicketEnabledFeatures extends JsonSerializableType
{
    /**
     * @var ?bool $sso Whether SSO configuration is enabled in this ticket.
     */
    #[JsonProperty('sso')]
    private ?bool $sso;

    /**
     * @var ?bool $domainVerification Whether domain verification is enabled in this ticket.
     */
    #[JsonProperty('domain_verification')]
    private ?bool $domainVerification;

    /**
     * @var ?bool $provisioning Whether provisioning configuration is enabled in this ticket.
     */
    #[JsonProperty('provisioning')]
    private ?bool $provisioning;

    /**
     * @param array{
     *   sso?: ?bool,
     *   domainVerification?: ?bool,
     *   provisioning?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->sso = $values['sso'] ?? null;
        $this->domainVerification = $values['domainVerification'] ?? null;
        $this->provisioning = $values['provisioning'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getSso(): ?bool
    {
        return $this->sso;
    }

    /**
     * @param ?bool $value
     */
    public function setSso(?bool $value = null): self
    {
        $this->sso = $value;
        $this->_setField('sso');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDomainVerification(): ?bool
    {
        return $this->domainVerification;
    }

    /**
     * @param ?bool $value
     */
    public function setDomainVerification(?bool $value = null): self
    {
        $this->domainVerification = $value;
        $this->_setField('domainVerification');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getProvisioning(): ?bool
    {
        return $this->provisioning;
    }

    /**
     * @param ?bool $value
     */
    public function setProvisioning(?bool $value = null): self
    {
        $this->provisioning = $value;
        $this->_setField('provisioning');
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
