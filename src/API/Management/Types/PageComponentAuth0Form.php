<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0Form extends JsonSerializableType
{
    /**
     * @var PageComponentAuth0FormConfig $config
     */
    #[JsonProperty('config')]
    private PageComponentAuth0FormConfig $config;

    /**
     * @param array{
     *   config: PageComponentAuth0FormConfig,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->config = $values['config'];
    }

    /**
     * @return PageComponentAuth0FormConfig
     */
    public function getConfig(): PageComponentAuth0FormConfig
    {
        return $this->config;
    }

    /**
     * @param PageComponentAuth0FormConfig $value
     */
    public function setConfig(PageComponentAuth0FormConfig $value): self
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
