<?php

namespace Auth0\SDK\API\Management\Organizations\DiscoveryDomains\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\OrganizationDiscoveryDomainStatus;

class CreateOrganizationDiscoveryDomainRequestContent extends JsonSerializableType
{
    /**
     * @var string $domain The domain name to associate with the organization e.g. acme.com.
     */
    #[JsonProperty('domain')]
    private string $domain;

    /**
     * @var ?value-of<OrganizationDiscoveryDomainStatus> $status
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @var ?bool $useForOrganizationDiscovery Indicates whether this domain should be used for organization discovery.
     */
    #[JsonProperty('use_for_organization_discovery')]
    private ?bool $useForOrganizationDiscovery;

    /**
     * @param array{
     *   domain: string,
     *   status?: ?value-of<OrganizationDiscoveryDomainStatus>,
     *   useForOrganizationDiscovery?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->domain = $values['domain'];
        $this->status = $values['status'] ?? null;
        $this->useForOrganizationDiscovery = $values['useForOrganizationDiscovery'] ?? null;
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
     * @return ?value-of<OrganizationDiscoveryDomainStatus>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<OrganizationDiscoveryDomainStatus> $value
     */
    public function setStatus(?string $value = null): self
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
}
