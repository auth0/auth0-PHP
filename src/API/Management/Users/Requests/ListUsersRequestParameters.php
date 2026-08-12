<?php

namespace Auth0\SDK\API\Management\Users\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\SearchEngineVersionsEnum;

class ListUsersRequestParameters extends JsonSerializableType
{
    /**
     * @var ?int $page Page index of the results to return. First page is 0.
     */
    private ?int $page = 0;

    /**
     * @var ?int $perPage Number of results per page.
     */
    private ?int $perPage = 50;

    /**
     * @var ?bool $includeTotals Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    private ?bool $includeTotals = true;

    /**
     * @var ?string $sort Field to sort by. Use <code>field:order</code> where order is <code>1</code> for ascending and <code>-1</code> for descending. e.g. <code>created_at:1</code>
     */
    private ?string $sort;

    /**
     * @var ?string $connection Connection filter. Only applies when using <code>search_engine=v1</code>. To filter by connection with <code>search_engine=v2|v3</code>, use <code>q=identities.connection:"connection_name"</code>
     */
    private ?string $connection;

    /**
     * @var ?string $fields Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
     */
    private ?string $fields;

    /**
     * @var ?bool $includeFields Whether specified fields are to be included (true) or excluded (false).
     */
    private ?bool $includeFields;

    /**
     * @var ?string $q Query in <a target='_new' href ='https://lucene.apache.org/core/2_9_4/queryparsersyntax.html'>Lucene query string syntax</a>. Some query types cannot be used on metadata fields, for details see <a href='https://auth0.com/docs/users/search/v3/query-syntax#searchable-fields'>Searchable Fields</a>.
     */
    private ?string $q;

    /**
     * @var ?value-of<SearchEngineVersionsEnum> $searchEngine The version of the search engine
     */
    private ?string $searchEngine;

    /**
     * @var ?bool $primaryOrder If true (default), results are returned in a deterministic order. If false, results may be returned in a non-deterministic order, which can enhance performance for complex queries targeting a small number of users. Set to false only when consistent ordering and pagination is not required.
     */
    private ?bool $primaryOrder;

    /**
     * @param array{
     *   page?: ?int,
     *   perPage?: ?int,
     *   includeTotals?: ?bool,
     *   sort?: ?string,
     *   connection?: ?string,
     *   fields?: ?string,
     *   includeFields?: ?bool,
     *   q?: ?string,
     *   searchEngine?: ?value-of<SearchEngineVersionsEnum>,
     *   primaryOrder?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
        $this->includeTotals = $values['includeTotals'] ?? null;
        $this->sort = $values['sort'] ?? null;
        $this->connection = $values['connection'] ?? null;
        $this->fields = $values['fields'] ?? null;
        $this->includeFields = $values['includeFields'] ?? null;
        $this->q = $values['q'] ?? null;
        $this->searchEngine = $values['searchEngine'] ?? null;
        $this->primaryOrder = $values['primaryOrder'] ?? null;
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
    public function getConnection(): ?string
    {
        return $this->connection;
    }

    /**
     * @param ?string $value
     */
    public function setConnection(?string $value = null): self
    {
        $this->connection = $value;
        $this->_setField('connection');
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
     * @return ?string
     */
    public function getQ(): ?string
    {
        return $this->q;
    }

    /**
     * @param ?string $value
     */
    public function setQ(?string $value = null): self
    {
        $this->q = $value;
        $this->_setField('q');
        return $this;
    }

    /**
     * @return ?value-of<SearchEngineVersionsEnum>
     */
    public function getSearchEngine(): ?string
    {
        return $this->searchEngine;
    }

    /**
     * @param ?value-of<SearchEngineVersionsEnum> $value
     */
    public function setSearchEngine(?string $value = null): self
    {
        $this->searchEngine = $value;
        $this->_setField('searchEngine');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPrimaryOrder(): ?bool
    {
        return $this->primaryOrder;
    }

    /**
     * @param ?bool $value
     */
    public function setPrimaryOrder(?bool $value = null): self
    {
        $this->primaryOrder = $value;
        $this->_setField('primaryOrder');
        return $this;
    }
}
