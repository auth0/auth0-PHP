<?php

namespace Auth0\SDK\API\Management\Logs\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListLogsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?int $page Page index of the results to return. First page is 0.
     */
    private ?int $page = 0;

    /**
     * @var ?int $perPage  Number of results per page. Paging is disabled if parameter not sent. Default: <code>50</code>. Max value: <code>100</code>
     */
    private ?int $perPage = 50;

    /**
     * @var ?string $sort Field to use for sorting appended with <code>:1</code>  for ascending and <code>:-1</code> for descending. e.g. <code>date:-1</code>
     */
    private ?string $sort;

    /**
     * @var ?string $fields Comma-separated list of fields to include or exclude (based on value provided for <code>include_fields</code>) in the result. Leave empty to retrieve all fields.
     */
    private ?string $fields;

    /**
     * @var ?bool $includeFields Whether specified fields are to be included (<code>true</code>) or excluded (<code>false</code>)
     */
    private ?bool $includeFields;

    /**
     * @var ?bool $includeTotals Return results as an array when false (default). Return results inside an object that also contains a total result count when true.
     */
    private ?bool $includeTotals = true;

    /**
     * Retrieves logs that match the specified search criteria. This parameter can be combined with all the others in the /api/logs endpoint but is specified separately for clarity.
     * If no fields are provided a case insensitive 'starts with' search is performed on all of the following fields: client_name, connection, user_name. Otherwise, you can specify multiple fields and specify the search using the %field%:%search%, for example: application:node user:"John@contoso.com".
     * Values specified without quotes are matched using a case insensitive 'starts with' search. If quotes are used a case insensitve exact search is used. If multiple fields are used, the AND operator is used to join the clauses.
     *
     * @var ?string $search
     */
    private ?string $search;

    /**
     * @param array{
     *   page?: ?int,
     *   perPage?: ?int,
     *   sort?: ?string,
     *   fields?: ?string,
     *   includeFields?: ?bool,
     *   includeTotals?: ?bool,
     *   search?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
        $this->sort = $values['sort'] ?? null;
        $this->fields = $values['fields'] ?? null;
        $this->includeFields = $values['includeFields'] ?? null;
        $this->includeTotals = $values['includeTotals'] ?? null;
        $this->search = $values['search'] ?? null;
    }

    /**
     * @return ?int
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @param ?int $value
     */
    public function setPage(?int $value = null): self
    {
        $this->page = $value;
        $this->_setField('page');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    /**
     * @param ?int $value
     */
    public function setPerPage(?int $value = null): self
    {
        $this->perPage = $value;
        $this->_setField('perPage');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSort(): ?string
    {
        return $this->sort;
    }

    /**
     * @param ?string $value
     */
    public function setSort(?string $value = null): self
    {
        $this->sort = $value;
        $this->_setField('sort');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFields(): ?string
    {
        return $this->fields;
    }

    /**
     * @param ?string $value
     */
    public function setFields(?string $value = null): self
    {
        $this->fields = $value;
        $this->_setField('fields');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIncludeFields(): ?bool
    {
        return $this->includeFields;
    }

    /**
     * @param ?bool $value
     */
    public function setIncludeFields(?bool $value = null): self
    {
        $this->includeFields = $value;
        $this->_setField('includeFields');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIncludeTotals(): ?bool
    {
        return $this->includeTotals;
    }

    /**
     * @param ?bool $value
     */
    public function setIncludeTotals(?bool $value = null): self
    {
        $this->includeTotals = $value;
        $this->_setField('includeTotals');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * @param ?string $value
     */
    public function setSearch(?string $value = null): self
    {
        $this->search = $value;
        $this->_setField('search');
        return $this;
    }
}
