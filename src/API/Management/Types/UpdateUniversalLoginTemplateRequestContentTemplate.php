<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateUniversalLoginTemplateRequestContentTemplate extends JsonSerializableType
{
    /**
     * @var string $template
     */
    #[JsonProperty('template')]
    private string $template;

    /**
     * @param array{
     *   template: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->template = $values['template'];
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $value
     */
    public function setTemplate(string $value): self
    {
        $this->template = $value;
        $this->_setField('template');
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
