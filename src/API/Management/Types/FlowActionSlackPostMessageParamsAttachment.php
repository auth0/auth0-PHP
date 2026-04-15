<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionSlackPostMessageParamsAttachment extends JsonSerializableType
{
    /**
     * @var ?value-of<FlowActionSlackPostMessageParamsAttachmentColor> $color
     */
    #[JsonProperty('color')]
    private ?string $color;

    /**
     * @var ?string $pretext
     */
    #[JsonProperty('pretext')]
    private ?string $pretext;

    /**
     * @var ?string $text
     */
    #[JsonProperty('text')]
    private ?string $text;

    /**
     * @var ?array<FlowActionSlackPostMessageParamsAttachmentField> $fields
     */
    #[JsonProperty('fields'), ArrayType([FlowActionSlackPostMessageParamsAttachmentField::class])]
    private ?array $fields;

    /**
     * @param array{
     *   color?: ?value-of<FlowActionSlackPostMessageParamsAttachmentColor>,
     *   pretext?: ?string,
     *   text?: ?string,
     *   fields?: ?array<FlowActionSlackPostMessageParamsAttachmentField>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->color = $values['color'] ?? null;
        $this->pretext = $values['pretext'] ?? null;
        $this->text = $values['text'] ?? null;
        $this->fields = $values['fields'] ?? null;
    }

    /**
     * @return ?value-of<FlowActionSlackPostMessageParamsAttachmentColor>
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param ?value-of<FlowActionSlackPostMessageParamsAttachmentColor> $value
     */
    public function setColor(?string $value = null): self
    {
        $this->color = $value;
        $this->_setField('color');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPretext(): ?string
    {
        return $this->pretext;
    }

    /**
     * @param ?string $value
     */
    public function setPretext(?string $value = null): self
    {
        $this->pretext = $value;
        $this->_setField('pretext');
        return $this;
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
     * @return ?array<FlowActionSlackPostMessageParamsAttachmentField>
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }

    /**
     * @param ?array<FlowActionSlackPostMessageParamsAttachmentField> $value
     */
    public function setFields(?array $value = null): self
    {
        $this->fields = $value;
        $this->_setField('fields');
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
