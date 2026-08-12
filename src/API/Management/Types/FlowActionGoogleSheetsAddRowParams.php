<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionGoogleSheetsAddRowParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $spreadsheetId
     */
    #[JsonProperty('spreadsheet_id')]
    private string $spreadsheetId;

    /**
     * @var (
     *    int
     *   |string
     * )|null $sheetId
     */
    #[JsonProperty('sheet_id'), Union('integer', 'string', 'null')]
    private int|string|null $sheetId;

    /**
     * @var ?array<?string> $values
     */
    #[JsonProperty('values'), ArrayType([new Union('string', 'null')])]
    private ?array $values;

    /**
     * @param array{
     *   connectionId: string,
     *   spreadsheetId: string,
     *   sheetId?: (
     *    int
     *   |string
     * )|null,
     *   values?: ?array<?string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->spreadsheetId = $values['spreadsheetId'];
        $this->sheetId = $values['sheetId'] ?? null;
        $this->values = $values['values'] ?? null;
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
    public function getSpreadsheetId(): string
    {
        return $this->spreadsheetId;
    }

    /**
     * @param string $value
     */
    public function setSpreadsheetId(string $value): self
    {
        $this->spreadsheetId = $value;
        $this->_setField('spreadsheetId');
        return $this;
    }

    /**
     * @return (
     *    int
     *   |string
     * )|null
     */
    public function getSheetId(): int|string|null
    {
        return $this->sheetId;
    }

    /**
     * @param (
     *    int
     *   |string
     * )|null $value
     */
    public function setSheetId(int|string|null $value = null): self
    {
        $this->sheetId = $value;
        $this->_setField('sheetId');
        return $this;
    }

    /**
     * @return ?array<?string>
     */
    public function getValues(): ?array
    {
        return $this->values;
    }

    /**
     * @param ?array<?string> $value
     */
    public function setValues(?array $value = null): self
    {
        $this->values = $value;
        $this->_setField('values');
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
