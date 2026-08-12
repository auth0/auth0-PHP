<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionPipedriveAddOrganizationParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var (
     *    string
     *   |float
     * )|null $ownerId
     */
    #[JsonProperty('owner_id'), Union('string', 'float', 'null')]
    private string|float|null $ownerId;

    /**
     * @var ?array<string, mixed> $fields
     */
    #[JsonProperty('fields'), ArrayType(['string' => 'mixed'])]
    private ?array $fields;

    /**
     * @param array{
     *   connectionId: string,
     *   name: string,
     *   ownerId?: (
     *    string
     *   |float
     * )|null,
     *   fields?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->name = $values['name'];
        $this->ownerId = $values['ownerId'] ?? null;
        $this->fields = $values['fields'] ?? null;
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |float
     * )|null
     */
    public function getOwnerId(): string|float|null
    {
        return $this->ownerId;
    }

    /**
     * @param (
     *    string
     *   |float
     * )|null $value
     */
    public function setOwnerId(string|float|null $value = null): self
    {
        $this->ownerId = $value;
        $this->_setField('ownerId');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }

    /**
     * @param ?array<string, mixed> $value
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
