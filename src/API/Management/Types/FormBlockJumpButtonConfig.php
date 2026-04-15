<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormBlockJumpButtonConfig extends JsonSerializableType
{
    /**
     * @var string $text
     */
    #[JsonProperty('text')]
    private string $text;

    /**
     * @var (
     *    string
     *   |value-of<FormEndingNodeId>
     * ) $nextNode
     */
    #[JsonProperty('next_node')]
    private string $nextNode;

    /**
     * @var ?FormBlockJumpButtonConfigStyle $style
     */
    #[JsonProperty('style')]
    private ?FormBlockJumpButtonConfigStyle $style;

    /**
     * @param array{
     *   text: string,
     *   nextNode: (
     *    string
     *   |value-of<FormEndingNodeId>
     * ),
     *   style?: ?FormBlockJumpButtonConfigStyle,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->text = $values['text'];
        $this->nextNode = $values['nextNode'];
        $this->style = $values['style'] ?? null;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $value
     */
    public function setText(string $value): self
    {
        $this->text = $value;
        $this->_setField('text');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |value-of<FormEndingNodeId>
     * )
     */
    public function getNextNode(): string
    {
        return $this->nextNode;
    }

    /**
     * @param (
     *    string
     *   |value-of<FormEndingNodeId>
     * ) $value
     */
    public function setNextNode(string $value): self
    {
        $this->nextNode = $value;
        $this->_setField('nextNode');
        return $this;
    }

    /**
     * @return ?FormBlockJumpButtonConfigStyle
     */
    public function getStyle(): ?FormBlockJumpButtonConfigStyle
    {
        return $this->style;
    }

    /**
     * @param ?FormBlockJumpButtonConfigStyle $value
     */
    public function setStyle(?FormBlockJumpButtonConfigStyle $value = null): self
    {
        $this->style = $value;
        $this->_setField('style');
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
