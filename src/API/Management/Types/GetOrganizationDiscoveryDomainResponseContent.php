<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GetOrganizationDiscoveryDomainResponseContent extends JsonSerializableType
{
    /**
     * @var string $id Organization discovery domain identifier.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $domain The domain name to associate with the organization e.g. acme.com.
     */
    #[JsonProperty('domain')]
    private string $domain;

    /**
     * @var value-of<OrganizationDiscoveryDomainStatus> $status
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @var ?bool $useForOrganizationDiscovery Indicates whether this domain should be used for organization discovery.
     */
    #[JsonProperty('use_for_organization_discovery')]
    private ?bool $useForOrganizationDiscovery;

    /**
     * @var string $verificationTxt A unique token generated for the discovery domain. This must be placed in a DNS TXT record at the location specified by the verification_host field to prove domain ownership.
     */
    #[JsonProperty('verification_txt')]
    private string $verificationTxt;

    /**
     * @var string $verificationHost The full domain where the TXT record should be added.
     */
    #[JsonProperty('verification_host')]
    private string $verificationHost;

    /**
     * @param array{
     *   id: string,
     *   domain: string,
     *   status: value-of<OrganizationDiscoveryDomainStatus>,
     *   verificationTxt: string,
     *   verificationHost: string,
     *   useForOrganizationDiscovery?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->domain = $values['domain'];
        $this->status = $values['status'];
        $this->useForOrganizationDiscovery = $values['useForOrganizationDiscovery'] ?? null;
        $this->verificationTxt = $values['verificationTxt'];
        $this->verificationHost = $values['verificationHost'];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $value
     */
    public function setDomain(string $value): self
    {
        $this->domain = $value;
        $this->_setField('domain');
        return $this;
    }

    /**
     * @return value-of<OrganizationDiscoveryDomainStatus>
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param value-of<OrganizationDiscoveryDomainStatus> $value
     */
    public function setStatus(string $value): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUseForOrganizationDiscovery(): ?bool
    {
        return $this->useForOrganizationDiscovery;
    }

    /**
     * @param ?bool $value
     */
    public function setUseForOrganizationDiscovery(?bool $value = null): self
    {
        $this->useForOrganizationDiscovery = $value;
        $this->_setField('useForOrganizationDiscovery');
        return $this;
    }

    /**
     * @return string
     */
    public function getVerificationTxt(): string
    {
        return $this->verificationTxt;
    }

    /**
     * @param string $value
     */
    public function setVerificationTxt(string $value): self
    {
        $this->verificationTxt = $value;
        $this->_setField('verificationTxt');
        return $this;
    }

    /**
     * @return string
     */
    public function getVerificationHost(): string
    {
        return $this->verificationHost;
    }

    /**
     * @param string $value
     */
    public function setVerificationHost(string $value): self
    {
        $this->verificationHost = $value;
        $this->_setField('verificationHost');
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
