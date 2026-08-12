<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class FormStartNode extends JsonSerializableType
{
    /**
     * @var ?array<FormHiddenField> $hiddenFields
     */
    #[JsonProperty('hidden_fields'), ArrayType([FormHiddenField::class])]
    private ?array $hiddenFields;

    /**
     * @var (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null $nextNode
     */
    #[JsonProperty('next_node'), Union('string', 'null')]
    private string|null $nextNode;

    /**
     * @var ?FormNodeCoordinates $coordinates
     */
    #[JsonProperty('coordinates')]
    private ?FormNodeCoordinates $coordinates;

    /**
     * @param array{
     *   hiddenFields?: ?array<FormHiddenField>,
     *   nextNode?: (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null,
     *   coordinates?: ?FormNodeCoordinates,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->hiddenFields = $values['hiddenFields'] ?? null;
        $this->nextNode = $values['nextNode'] ?? null;
        $this->coordinates = $values['coordinates'] ?? null;
    }

    /**
     * @return ?array<FormHiddenField>
     */
    public function getHiddenFields(): ?array
    {
        return $this->hiddenFields;
    }

    /**
     * @param ?array<FormHiddenField> $value
     */
    public function setHiddenFields(?array $value = null): self
    {
        $this->hiddenFields = $value;
        $this->_setField('hiddenFields');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null
     */
    public function getNextNode(): string|null
    {
        return $this->nextNode;
    }

    /**
     * @param (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null $value
     */
    public function setNextNode(string|null $value = null): self
    {
        $this->nextNode = $value;
        $this->_setField('nextNode');
        return $this;
    }

    /**
     * @return ?FormNodeCoordinates
     */
    public function getCoordinates(): ?FormNodeCoordinates
    {
        return $this->coordinates;
    }

    /**
     * @param ?FormNodeCoordinates $value
     */
    public function setCoordinates(?FormNodeCoordinates $value = null): self
    {
        $this->coordinates = $value;
        $this->_setField('coordinates');
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
