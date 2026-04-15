<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class FormRouterRule extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var ?string $alias
     */
    #[JsonProperty('alias')]
    private ?string $alias;

    /**
     * @var (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null $nextNode
     */
    #[JsonProperty('next_node'), Union('string', 'null')]
    private string|null $nextNode;

    /**
     * @param array{
     *   id: string,
     *   alias?: ?string,
     *   nextNode?: (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->alias = $values['alias'] ?? null;
        $this->nextNode = $values['nextNode'] ?? null;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @param ?string $value
     */
    public function setAlias(?string $value = null): self
    {
        $this->alias = $value;
        $this->_setField('alias');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
