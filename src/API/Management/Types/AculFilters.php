<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Optional filters to apply rendering rules to specific entities
 */
class AculFilters extends JsonSerializableType
{
    /**
     * @var ?value-of<AculMatchTypeEnum> $matchType
     */
    #[JsonProperty('match_type')]
    private ?string $matchType;

    /**
     * @var ?array<(
     *    AculClientFilterById
     *   |AculClientFilterByMetadata
     * )> $clients Clients filter
     */
    #[JsonProperty('clients'), ArrayType([new Union(AculClientFilterById::class, AculClientFilterByMetadata::class)])]
    private ?array $clients;

    /**
     * @var ?array<(
     *    AculOrganizationFilterById
     *   |AculOrganizationFilterByMetadata
     * )> $organizations Organizations filter
     */
    #[JsonProperty('organizations'), ArrayType([new Union(AculOrganizationFilterById::class, AculOrganizationFilterByMetadata::class)])]
    private ?array $organizations;

    /**
     * @var ?array<(
     *    AculDomainFilterById
     *   |AculDomainFilterByMetadata
     * )> $domains Domains filter
     */
    #[JsonProperty('domains'), ArrayType([new Union(AculDomainFilterById::class, AculDomainFilterByMetadata::class)])]
    private ?array $domains;

    /**
     * @param array{
     *   matchType?: ?value-of<AculMatchTypeEnum>,
     *   clients?: ?array<(
     *    AculClientFilterById
     *   |AculClientFilterByMetadata
     * )>,
     *   organizations?: ?array<(
     *    AculOrganizationFilterById
     *   |AculOrganizationFilterByMetadata
     * )>,
     *   domains?: ?array<(
     *    AculDomainFilterById
     *   |AculDomainFilterByMetadata
     * )>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->matchType = $values['matchType'] ?? null;
        $this->clients = $values['clients'] ?? null;
        $this->organizations = $values['organizations'] ?? null;
        $this->domains = $values['domains'] ?? null;
    }

    /**
     * @return ?value-of<AculMatchTypeEnum>
     */
    public function getMatchType(): ?string
    {
        return $this->matchType;
    }

    /**
     * @param ?value-of<AculMatchTypeEnum> $value
     */
    public function setMatchType(?string $value = null): self
    {
        $this->matchType = $value;
        $this->_setField('matchType');
        return $this;
    }

    /**
     * @return ?array<(
     *    AculClientFilterById
     *   |AculClientFilterByMetadata
     * )>
     */
    public function getClients(): ?array
    {
        return $this->clients;
    }

    /**
     * @param ?array<(
     *    AculClientFilterById
     *   |AculClientFilterByMetadata
     * )> $value
     */
    public function setClients(?array $value = null): self
    {
        $this->clients = $value;
        $this->_setField('clients');
        return $this;
    }

    /**
     * @return ?array<(
     *    AculOrganizationFilterById
     *   |AculOrganizationFilterByMetadata
     * )>
     */
    public function getOrganizations(): ?array
    {
        return $this->organizations;
    }

    /**
     * @param ?array<(
     *    AculOrganizationFilterById
     *   |AculOrganizationFilterByMetadata
     * )> $value
     */
    public function setOrganizations(?array $value = null): self
    {
        $this->organizations = $value;
        $this->_setField('organizations');
        return $this;
    }

    /**
     * @return ?array<(
     *    AculDomainFilterById
     *   |AculDomainFilterByMetadata
     * )>
     */
    public function getDomains(): ?array
    {
        return $this->domains;
    }

    /**
     * @param ?array<(
     *    AculDomainFilterById
     *   |AculDomainFilterByMetadata
     * )> $value
     */
    public function setDomains(?array $value = null): self
    {
        $this->domains = $value;
        $this->_setField('domains');
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
