<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldBooleanConfigOptions extends JsonSerializableType
{
    /**
     * @var ?string $true
     */
    #[JsonProperty('true')]
    private ?string $true;

    /**
     * @var ?string $false
     */
    #[JsonProperty('false')]
    private ?string $false;

    /**
     * @param array{
     *   true?: ?string,
     *   false?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->true = $values['true'] ?? null;
        $this->false = $values['false'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getTrue(): ?string
    {
        return $this->true;
    }

    /**
     * @param ?string $value
     */
    public function setTrue(?string $value = null): self
    {
        $this->true = $value;
        $this->_setField('true');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFalse(): ?string
    {
        return $this->false;
    }

    /**
     * @param ?string $value
     */
    public function setFalse(?string $value = null): self
    {
        $this->false = $value;
        $this->_setField('false');
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
