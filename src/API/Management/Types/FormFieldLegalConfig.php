<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldLegalConfig extends JsonSerializableType
{
    /**
     * @var ?string $text
     */
    #[JsonProperty('text')]
    private ?string $text;

    /**
     * @param array{
     *   text?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->text = $values['text'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param ?string $value
     */
    public function setText(?string $value = null): self
    {
        $this->text = $value;
        $this->_setField('text');
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
