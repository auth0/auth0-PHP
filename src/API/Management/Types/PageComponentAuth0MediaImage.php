<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0MediaImage extends JsonSerializableType
{
    /**
     * @var PageComponentAuth0MediaImageConfig $config
     */
    #[JsonProperty('config')]
    private PageComponentAuth0MediaImageConfig $config;

    /**
     * @param array{
     *   config: PageComponentAuth0MediaImageConfig,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->config = $values['config'];
    }

    /**
     * @return PageComponentAuth0MediaImageConfig
     */
    public function getConfig(): PageComponentAuth0MediaImageConfig
    {
        return $this->config;
    }

    /**
     * @param PageComponentAuth0MediaImageConfig $value
     */
    public function setConfig(PageComponentAuth0MediaImageConfig $value): self
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
