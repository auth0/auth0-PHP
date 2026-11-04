<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Deprecated. Use "sidebar:component:auth0:external_link:v2" instead.
 */
class SidebarComponentAuth0ExternalLink extends JsonSerializableType
{
    /**
     * @var SidebarComponentAuth0ExternalLinkConfig $config
     */
    #[JsonProperty('config')]
    private SidebarComponentAuth0ExternalLinkConfig $config;

    /**
     * @param array{
     *   config: SidebarComponentAuth0ExternalLinkConfig,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->config = $values['config'];
    }

    /**
     * @return SidebarComponentAuth0ExternalLinkConfig
     */
    public function getConfig(): SidebarComponentAuth0ExternalLinkConfig
    {
        return $this->config;
    }

    /**
     * @param SidebarComponentAuth0ExternalLinkConfig $value
     */
    public function setConfig(SidebarComponentAuth0ExternalLinkConfig $value): self
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
