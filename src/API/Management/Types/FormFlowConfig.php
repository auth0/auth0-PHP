<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class FormFlowConfig extends JsonSerializableType
{
    /**
     * @var string $flowId
     */
    #[JsonProperty('flow_id')]
    private string $flowId;

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
     *   flowId: string,
     *   nextNode?: (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->flowId = $values['flowId'];
        $this->nextNode = $values['nextNode'] ?? null;
    }

    /**
     * @return string
     */
    public function getFlowId(): string
    {
        return $this->flowId;
    }

    /**
     * @param string $value
     */
    public function setFlowId(string $value): self
    {
        $this->flowId = $value;
        $this->_setField('flowId');
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
