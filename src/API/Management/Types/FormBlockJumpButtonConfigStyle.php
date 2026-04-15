<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormBlockJumpButtonConfigStyle extends JsonSerializableType
{
    /**
     * @var ?string $backgroundColor
     */
    #[JsonProperty('background_color')]
    private ?string $backgroundColor;

    /**
     * @param array{
     *   backgroundColor?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->backgroundColor = $values['backgroundColor'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    /**
     * @param ?string $value
     */
    public function setBackgroundColor(?string $value = null): self
    {
        $this->backgroundColor = $value;
        $this->_setField('backgroundColor');
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
