<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionAirtableListRecordsParams extends JsonSerializableType
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
     * @var ?string $query
     */
    #[JsonProperty('query')]
    private ?string $query;

    /**
     * @var ?string $view
     */
    #[JsonProperty('view')]
    private ?string $view;

    /**
     * @param array{
     *   connectionId: string,
     *   baseId: string,
     *   tableName: string,
     *   query?: ?string,
     *   view?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->baseId = $values['baseId'];
        $this->tableName = $values['tableName'];
        $this->query = $values['query'] ?? null;
        $this->view = $values['view'] ?? null;
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
     * @return ?string
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * @param ?string $value
     */
    public function setQuery(?string $value = null): self
    {
        $this->query = $value;
        $this->_setField('query');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getView(): ?string
    {
        return $this->view;
    }

    /**
     * @param ?string $value
     */
    public function setView(?string $value = null): self
    {
        $this->view = $value;
        $this->_setField('view');
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
