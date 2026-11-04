<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0TypographyRichText extends JsonSerializableType
{
    /**
     * @var PageComponentAuth0TypographyRichTextConfig $config
     */
    #[JsonProperty('config')]
    private PageComponentAuth0TypographyRichTextConfig $config;

    /**
     * @param array{
     *   config: PageComponentAuth0TypographyRichTextConfig,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->config = $values['config'];
    }

    /**
     * @return PageComponentAuth0TypographyRichTextConfig
     */
    public function getConfig(): PageComponentAuth0TypographyRichTextConfig
    {
        return $this->config;
    }

    /**
     * @param PageComponentAuth0TypographyRichTextConfig $value
     */
    public function setConfig(PageComponentAuth0TypographyRichTextConfig $value): self
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
