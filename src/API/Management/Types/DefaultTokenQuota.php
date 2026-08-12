<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Token Quota configuration, to configure quotas for token issuance for clients and organizations. Applied to all clients and organizations unless overridden in individual client or organization settings.
 */
class DefaultTokenQuota extends JsonSerializableType
{
    /**
     * @var ?TokenQuotaConfiguration $clients
     */
    #[JsonProperty('clients')]
    private ?TokenQuotaConfiguration $clients;

    /**
     * @var ?TokenQuotaConfiguration $organizations
     */
    #[JsonProperty('organizations')]
    private ?TokenQuotaConfiguration $organizations;

    /**
     * @param array{
     *   clients?: ?TokenQuotaConfiguration,
     *   organizations?: ?TokenQuotaConfiguration,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->clients = $values['clients'] ?? null;
        $this->organizations = $values['organizations'] ?? null;
    }

    /**
     * @return ?TokenQuotaConfiguration
     */
    public function getClients(): ?TokenQuotaConfiguration
    {
        return $this->clients;
    }

    /**
     * @param ?TokenQuotaConfiguration $value
     */
    public function setClients(?TokenQuotaConfiguration $value = null): self
    {
        $this->clients = $value;
        $this->_setField('clients');
        return $this;
    }

    /**
     * @return ?TokenQuotaConfiguration
     */
    public function getOrganizations(): ?TokenQuotaConfiguration
    {
        return $this->organizations;
    }

    /**
     * @param ?TokenQuotaConfiguration $value
     */
    public function setOrganizations(?TokenQuotaConfiguration $value = null): self
    {
        $this->organizations = $value;
        $this->_setField('organizations');
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
