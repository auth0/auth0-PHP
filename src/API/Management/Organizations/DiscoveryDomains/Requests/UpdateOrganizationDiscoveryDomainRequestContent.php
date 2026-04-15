<?php

namespace Auth0\SDK\API\Management\Organizations\DiscoveryDomains\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\OrganizationDiscoveryDomainStatus;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateOrganizationDiscoveryDomainRequestContent extends JsonSerializableType
{
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
     *   status?: ?value-of<OrganizationDiscoveryDomainStatus>,
     *   useForOrganizationDiscovery?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->status = $values['status'] ?? null;
        $this->useForOrganizationDiscovery = $values['useForOrganizationDiscovery'] ?? null;
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
