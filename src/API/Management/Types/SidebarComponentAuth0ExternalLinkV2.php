<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SidebarComponentAuth0ExternalLinkV2 extends JsonSerializableType
{
    /**
     * @var SidebarComponentAuth0ExternalLinkV2Config $config
     */
    #[JsonProperty('config')]
    private SidebarComponentAuth0ExternalLinkV2Config $config;

    /**
     * @param array{
     *   config: SidebarComponentAuth0ExternalLinkV2Config,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->config = $values['config'];
    }

    /**
     * @return SidebarComponentAuth0ExternalLinkV2Config
     */
    public function getConfig(): SidebarComponentAuth0ExternalLinkV2Config
    {
        return $this->config;
    }

    /**
     * @param SidebarComponentAuth0ExternalLinkV2Config $value
     */
    public function setConfig(SidebarComponentAuth0ExternalLinkV2Config $value): self
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
