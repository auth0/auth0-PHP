<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PhoneTemplateBody extends JsonSerializableType
{
    /**
     * @var ?string $text Content of the phone template for text notifications
     */
    #[JsonProperty('text')]
    private ?string $text;

    /**
     * @var ?string $voice Content of the phone template for voice notifications
     */
    #[JsonProperty('voice')]
    private ?string $voice;

    /**
     * @param array{
     *   text?: ?string,
     *   voice?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->text = $values['text'] ?? null;
        $this->voice = $values['voice'] ?? null;
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
     * @return ?string
     */
    public function getVoice(): ?string
    {
        return $this->voice;
    }

    /**
     * @param ?string $value
     */
    public function setVoice(?string $value = null): self
    {
        $this->voice = $value;
        $this->_setField('voice');
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
