<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SidebarComponentAuth0InternalLinkV2 extends JsonSerializableType
{
    /**
     * @var SidebarComponentAuth0InternalLinkV2Config $config
     */
    #[JsonProperty('config')]
    private SidebarComponentAuth0InternalLinkV2Config $config;

    /**
     * @param array{
     *   config: SidebarComponentAuth0InternalLinkV2Config,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->config = $values['config'];
    }

    /**
     * @return SidebarComponentAuth0InternalLinkV2Config
     */
    public function getConfig(): SidebarComponentAuth0InternalLinkV2Config
    {
        return $this->config;
    }

    /**
     * @param SidebarComponentAuth0InternalLinkV2Config $value
     */
    public function setConfig(SidebarComponentAuth0InternalLinkV2Config $value): self
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
