<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionAirtableUpdateRecordParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $baseId
     */
    #[JsonProperty('base_id')]
    private string $baseId;

    /**
     * @var string $tableName
     */
    #[JsonProperty('table_name')]
    private string $tableName;

    /**
     * @var string $recordId
     */
    #[JsonProperty('record_id')]
    private string $recordId;

    /**
     * @var ?array<string, mixed> $fields
     */
    #[JsonProperty('fields'), ArrayType(['string' => 'mixed'])]
    private ?array $fields;

    /**
     * @param array{
     *   connectionId: string,
     *   baseId: string,
     *   tableName: string,
     *   recordId: string,
     *   fields?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->baseId = $values['baseId'];
        $this->tableName = $values['tableName'];
        $this->recordId = $values['recordId'];
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
    public function getBaseId(): string
    {
        return $this->baseId;
    }

    /**
     * @param string $value
     */
    public function setBaseId(string $value): self
    {
        $this->baseId = $value;
        $this->_setField('baseId');
        return $this;
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @param string $value
     */
    public function setTableName(string $value): self
    {
        $this->tableName = $value;
        $this->_setField('tableName');
        return $this;
    }

    /**
     * @return string
     */
    public function getRecordId(): string
    {
        return $this->recordId;
    }

    /**
     * @param string $value
     */
    public function setRecordId(string $value): self
    {
        $this->recordId = $value;
        $this->_setField('recordId');
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
