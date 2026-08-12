<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionMailjetSendEmailParamsContent extends JsonSerializableType
{
    /**
     * @var string $content
     */
    #[JsonProperty('content')]
    private string $content;

    /**
     * @param array{
     *   content: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->content = $values['content'];
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $value
     */
    public function setContent(string $value): self
    {
        $this->content = $value;
        $this->_setField('content');
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
