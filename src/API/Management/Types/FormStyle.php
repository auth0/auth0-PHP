<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormStyle extends JsonSerializableType
{
    /**
     * @var ?string $css
     */
    #[JsonProperty('css')]
    private ?string $css;

    /**
     * @param array{
     *   css?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->css = $values['css'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getCss(): ?string
    {
        return $this->css;
    }

    /**
     * @param ?string $value
     */
    public function setCss(?string $value = null): self
    {
        $this->css = $value;
        $this->_setField('css');
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
