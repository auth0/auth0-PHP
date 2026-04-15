<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionSlackPostMessageParamsAttachmentField extends JsonSerializableType
{
    /**
     * @var string $title
     */
    #[JsonProperty('title')]
    private string $title;

    /**
     * @var ?string $value
     */
    #[JsonProperty('value')]
    private ?string $value;

    /**
     * @var ?bool $short
     */
    #[JsonProperty('short')]
    private ?bool $short;

    /**
     * @param array{
     *   title: string,
     *   value?: ?string,
     *   short?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->title = $values['title'];
        $this->value = $values['value'] ?? null;
        $this->short = $values['short'] ?? null;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $value
     */
    public function setTitle(string $value): self
    {
        $this->title = $value;
        $this->_setField('title');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param ?string $value
     */
    public function setValue(?string $value = null): self
    {
        $this->value = $value;
        $this->_setField('value');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getShort(): ?bool
    {
        return $this->short;
    }

    /**
     * @param ?bool $value
     */
    public function setShort(?bool $value = null): self
    {
        $this->short = $value;
        $this->_setField('short');
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
