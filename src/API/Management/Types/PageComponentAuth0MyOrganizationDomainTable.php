<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0MyOrganizationDomainTable extends JsonSerializableType
{
    /**
     * @var ?PageComponentAuth0MyOrganizationDomainTableConfig $config
     */
    #[JsonProperty('config')]
    private ?PageComponentAuth0MyOrganizationDomainTableConfig $config;

    /**
     * @param array{
     *   config?: ?PageComponentAuth0MyOrganizationDomainTableConfig,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->config = $values['config'] ?? null;
    }

    /**
     * @return ?PageComponentAuth0MyOrganizationDomainTableConfig
     */
    public function getConfig(): ?PageComponentAuth0MyOrganizationDomainTableConfig
    {
        return $this->config;
    }

    /**
     * @param ?PageComponentAuth0MyOrganizationDomainTableConfig $value
     */
    public function setConfig(?PageComponentAuth0MyOrganizationDomainTableConfig $value = null): self
    {
        $this->config = $value;
        $this->_setField('config');
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
