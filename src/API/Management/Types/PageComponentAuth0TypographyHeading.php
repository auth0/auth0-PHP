<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0TypographyHeading extends JsonSerializableType
{
    /**
     * @var PageComponentAuth0TypographyHeadingConfig $config
     */
    #[JsonProperty('config')]
    private PageComponentAuth0TypographyHeadingConfig $config;

    /**
     * @param array{
     *   config: PageComponentAuth0TypographyHeadingConfig,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->config = $values['config'];
    }

    /**
     * @return PageComponentAuth0TypographyHeadingConfig
     */
    public function getConfig(): PageComponentAuth0TypographyHeadingConfig
    {
        return $this->config;
    }

    /**
     * @param PageComponentAuth0TypographyHeadingConfig $value
     */
    public function setConfig(PageComponentAuth0TypographyHeadingConfig $value): self
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
