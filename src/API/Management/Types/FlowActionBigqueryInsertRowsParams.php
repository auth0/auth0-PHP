<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionBigqueryInsertRowsParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $datasetId
     */
    #[JsonProperty('dataset_id')]
    private string $datasetId;

    /**
     * @var string $tableId
     */
    #[JsonProperty('table_id')]
    private string $tableId;

    /**
     * @var ?array<string, mixed> $data
     */
    #[JsonProperty('data'), ArrayType(['string' => 'mixed'])]
    private ?array $data;

    /**
     * @param array{
     *   connectionId: string,
     *   datasetId: string,
     *   tableId: string,
     *   data?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->datasetId = $values['datasetId'];
        $this->tableId = $values['tableId'];
        $this->data = $values['data'] ?? null;
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
    public function getDatasetId(): string
    {
        return $this->datasetId;
    }

    /**
     * @param string $value
     */
    public function setDatasetId(string $value): self
    {
        $this->datasetId = $value;
        $this->_setField('datasetId');
        return $this;
    }

    /**
     * @return string
     */
    public function getTableId(): string
    {
        return $this->tableId;
    }

    /**
     * @param string $value
     */
    public function setTableId(string $value): self
    {
        $this->tableId = $value;
        $this->_setField('tableId');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setData(?array $value = null): self
    {
        $this->data = $value;
        $this->_setField('data');
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
