<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Deprecated. Use "sidebar:component:auth0:internal_link:v2" instead.
 */
class SidebarComponentAuth0InternalLink extends JsonSerializableType
{
    /**
     * @var SidebarComponentAuth0InternalLinkConfig $config
     */
    #[JsonProperty('config')]
    private SidebarComponentAuth0InternalLinkConfig $config;

    /**
     * @param array{
     *   config: SidebarComponentAuth0InternalLinkConfig,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->config = $values['config'];
    }

    /**
     * @return SidebarComponentAuth0InternalLinkConfig
     */
    public function getConfig(): SidebarComponentAuth0InternalLinkConfig
    {
        return $this->config;
    }

    /**
     * @param SidebarComponentAuth0InternalLinkConfig $value
     */
    public function setConfig(SidebarComponentAuth0InternalLinkConfig $value): self
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
