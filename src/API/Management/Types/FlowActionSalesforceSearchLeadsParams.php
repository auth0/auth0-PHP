<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionSalesforceSearchLeadsParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var value-of<FlowActionSalesforceSearchLeadsParamsSearchField> $searchField
     */
    #[JsonProperty('search_field')]
    private string $searchField;

    /**
     * @var string $searchValue
     */
    #[JsonProperty('search_value')]
    private string $searchValue;

    /**
     * @var array<string> $leadFields
     */
    #[JsonProperty('lead_fields'), ArrayType(['string'])]
    private array $leadFields;

    /**
     * @param array{
     *   connectionId: string,
     *   searchField: value-of<FlowActionSalesforceSearchLeadsParamsSearchField>,
     *   searchValue: string,
     *   leadFields: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->searchField = $values['searchField'];
        $this->searchValue = $values['searchValue'];
        $this->leadFields = $values['leadFields'];
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
     * @return value-of<FlowActionSalesforceSearchLeadsParamsSearchField>
     */
    public function getSearchField(): string
    {
        return $this->searchField;
    }

    /**
     * @param value-of<FlowActionSalesforceSearchLeadsParamsSearchField> $value
     */
    public function setSearchField(string $value): self
    {
        $this->searchField = $value;
        $this->_setField('searchField');
        return $this;
    }

    /**
     * @return string
     */
    public function getSearchValue(): string
    {
        return $this->searchValue;
    }

    /**
     * @param string $value
     */
    public function setSearchValue(string $value): self
    {
        $this->searchValue = $value;
        $this->_setField('searchValue');
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getLeadFields(): array
    {
        return $this->leadFields;
    }

    /**
     * @param array<string> $value
     */
    public function setLeadFields(array $value): self
    {
        $this->leadFields = $value;
        $this->_setField('leadFields');
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
