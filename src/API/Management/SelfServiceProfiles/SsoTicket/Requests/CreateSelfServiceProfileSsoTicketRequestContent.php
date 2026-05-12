<?php

namespace Auth0\SDK\API\Management\SelfServiceProfiles\SsoTicket\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\SelfServiceProfileSsoTicketConnectionConfig;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\SelfServiceProfileSsoTicketEnabledOrganization;
use Auth0\SDK\API\Management\Types\SelfServiceProfileSsoTicketDomainAliasesConfig;
use Auth0\SDK\API\Management\Types\SelfServiceProfileSsoTicketProvisioningConfig;
use Auth0\SDK\API\Management\Types\SelfServiceProfileSsoTicketEnabledFeatures;

class CreateSelfServiceProfileSsoTicketRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $connectionId If provided, this will allow editing of the provided connection during the Self-Service Enterprise Configuration flow
     */
    #[JsonProperty('connection_id')]
    private ?string $connectionId;

    /**
     * @var ?SelfServiceProfileSsoTicketConnectionConfig $connectionConfig
     */
    #[JsonProperty('connection_config')]
    private ?SelfServiceProfileSsoTicketConnectionConfig $connectionConfig;

    /**
     * @var ?array<string> $enabledClients List of client_ids that the connection will be enabled for.
     */
    #[JsonProperty('enabled_clients'), ArrayType(['string'])]
    private ?array $enabledClients;

    /**
     * @var ?array<SelfServiceProfileSsoTicketEnabledOrganization> $enabledOrganizations List of organizations that the connection will be enabled for.
     */
    #[JsonProperty('enabled_organizations'), ArrayType([SelfServiceProfileSsoTicketEnabledOrganization::class])]
    private ?array $enabledOrganizations;

    /**
     * @var ?int $ttlSec Number of seconds for which the ticket is valid before expiration. If unspecified or set to 0, this value defaults to 432000 seconds (5 days).
     */
    #[JsonProperty('ttl_sec')]
    private ?int $ttlSec;

    /**
     * @var ?SelfServiceProfileSsoTicketDomainAliasesConfig $domainAliasesConfig
     */
    #[JsonProperty('domain_aliases_config')]
    private ?SelfServiceProfileSsoTicketDomainAliasesConfig $domainAliasesConfig;

    /**
     * @var ?SelfServiceProfileSsoTicketProvisioningConfig $provisioningConfig
     */
    #[JsonProperty('provisioning_config')]
    private ?SelfServiceProfileSsoTicketProvisioningConfig $provisioningConfig;

    /**
     * @var ?bool $useForOrganizationDiscovery Indicates whether a verified domain should be used for organization discovery during authentication.
     */
    #[JsonProperty('use_for_organization_discovery')]
    private ?bool $useForOrganizationDiscovery;

    /**
     * @var ?SelfServiceProfileSsoTicketEnabledFeatures $enabledFeatures
     */
    #[JsonProperty('enabled_features')]
    private ?SelfServiceProfileSsoTicketEnabledFeatures $enabledFeatures;

    /**
     * @param array{
     *   connectionId?: ?string,
     *   connectionConfig?: ?SelfServiceProfileSsoTicketConnectionConfig,
     *   enabledClients?: ?array<string>,
     *   enabledOrganizations?: ?array<SelfServiceProfileSsoTicketEnabledOrganization>,
     *   ttlSec?: ?int,
     *   domainAliasesConfig?: ?SelfServiceProfileSsoTicketDomainAliasesConfig,
     *   provisioningConfig?: ?SelfServiceProfileSsoTicketProvisioningConfig,
     *   useForOrganizationDiscovery?: ?bool,
     *   enabledFeatures?: ?SelfServiceProfileSsoTicketEnabledFeatures,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->connectionId = $values['connectionId'] ?? null;
        $this->connectionConfig = $values['connectionConfig'] ?? null;
        $this->enabledClients = $values['enabledClients'] ?? null;
        $this->enabledOrganizations = $values['enabledOrganizations'] ?? null;
        $this->ttlSec = $values['ttlSec'] ?? null;
        $this->domainAliasesConfig = $values['domainAliasesConfig'] ?? null;
        $this->provisioningConfig = $values['provisioningConfig'] ?? null;
        $this->useForOrganizationDiscovery = $values['useForOrganizationDiscovery'] ?? null;
        $this->enabledFeatures = $values['enabledFeatures'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getConnectionId(): ?string
    {
        return $this->connectionId;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionId(?string $value = null): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return ?SelfServiceProfileSsoTicketConnectionConfig
     */
    public function getConnectionConfig(): ?SelfServiceProfileSsoTicketConnectionConfig
    {
        return $this->connectionConfig;
    }

    /**
     * @param ?SelfServiceProfileSsoTicketConnectionConfig $value
     */
    public function setConnectionConfig(?SelfServiceProfileSsoTicketConnectionConfig $value = null): self
    {
        $this->connectionConfig = $value;
        $this->_setField('connectionConfig');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getEnabledClients(): ?array
    {
        return $this->enabledClients;
    }

    /**
     * @param ?array<string> $value
     */
    public function setEnabledClients(?array $value = null): self
    {
        $this->enabledClients = $value;
        $this->_setField('enabledClients');
        return $this;
    }

    /**
     * @return ?array<SelfServiceProfileSsoTicketEnabledOrganization>
     */
    public function getEnabledOrganizations(): ?array
    {
        return $this->enabledOrganizations;
    }

    /**
     * @param ?array<SelfServiceProfileSsoTicketEnabledOrganization> $value
     */
    public function setEnabledOrganizations(?array $value = null): self
    {
        $this->enabledOrganizations = $value;
        $this->_setField('enabledOrganizations');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTtlSec(): ?int
    {
        return $this->ttlSec;
    }

    /**
     * @param ?int $value
     */
    public function setTtlSec(?int $value = null): self
    {
        $this->ttlSec = $value;
        $this->_setField('ttlSec');
        return $this;
    }

    /**
     * @return ?SelfServiceProfileSsoTicketDomainAliasesConfig
     */
    public function getDomainAliasesConfig(): ?SelfServiceProfileSsoTicketDomainAliasesConfig
    {
        return $this->domainAliasesConfig;
    }

    /**
     * @param ?SelfServiceProfileSsoTicketDomainAliasesConfig $value
     */
    public function setDomainAliasesConfig(?SelfServiceProfileSsoTicketDomainAliasesConfig $value = null): self
    {
        $this->domainAliasesConfig = $value;
        $this->_setField('domainAliasesConfig');
        return $this;
    }

    /**
     * @return ?SelfServiceProfileSsoTicketProvisioningConfig
     */
    public function getProvisioningConfig(): ?SelfServiceProfileSsoTicketProvisioningConfig
    {
        return $this->provisioningConfig;
    }

    /**
     * @param ?SelfServiceProfileSsoTicketProvisioningConfig $value
     */
    public function setProvisioningConfig(?SelfServiceProfileSsoTicketProvisioningConfig $value = null): self
    {
        $this->provisioningConfig = $value;
        $this->_setField('provisioningConfig');
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
     * @return ?SelfServiceProfileSsoTicketEnabledFeatures
     */
    public function getEnabledFeatures(): ?SelfServiceProfileSsoTicketEnabledFeatures
    {
        return $this->enabledFeatures;
    }

    /**
     * @param ?SelfServiceProfileSsoTicketEnabledFeatures $value
     */
    public function setEnabledFeatures(?SelfServiceProfileSsoTicketEnabledFeatures $value = null): self
    {
        $this->enabledFeatures = $value;
        $this->_setField('enabledFeatures');
        return $this;
    }
}
