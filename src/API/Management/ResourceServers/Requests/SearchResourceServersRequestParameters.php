<?php

namespace Auth0\SDK\API\Management\ResourceServers\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\SearchParserEnum;
use Auth0\SDK\API\Management\Types\ResourceServerSortFieldEnum;

class SearchResourceServersRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $q Filter expression in SCIM or Lucene syntax (depending on parser parameter). SCIM examples: `name eq "My API"`, `identifier sw "https://"`. SCIM operators: eq, ne, sw, ew, co, pr, gt, ge, lt, le, and, or. <br /><br /><b>Supported Fields</b>:<ul><li><i>id</i> - Filter by resource server ID</li><li><i>identifier</i> - Filter by resource server identifier</li><li><i>name</i> - Filter by resource server name</li><li><i>updated_at</i> - Filter by last update date</li></ul>Maximum 5 filter operations per query. Results are eventually consistent and may not reflect recent updates.
     */
    private ?string $q;

    /**
     * @var ?value-of<SearchParserEnum> $parser Query parser to use for the filter expression. Use "scim" for SCIM filter syntax or "lucene" for Lucene query syntax (default).
     */
    private ?string $parser;

    /**
     * @var ?string $fields Comma-separated list of fields to include or exclude in the response. Works with the include_fields parameter to control projection mode.
     */
    private ?string $fields;

    /**
     * @var ?bool $includeFields Controls field projection mode. Set to true to include only fields specified in the fields parameter. Set to false to exclude fields specified in the fields parameter. Defaults to true if not specified.
     */
    private ?bool $includeFields;

    /**
     * @var ?int $take Maximum number of results to return per page (1-100). Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @var ?string $from Cursor for the next page of results. Use the value from the next field in the previous response.
     */
    private ?string $from;

    /**
     * @var ?value-of<ResourceServerSortFieldEnum> $sort Field name to sort results by in ascending order only. Defaults to insertion order (oldest first) if not provided.
     */
    private ?string $sort;

    /**
     * @param array{
     *   q?: ?string,
     *   parser?: ?value-of<SearchParserEnum>,
     *   fields?: ?string,
     *   includeFields?: ?bool,
     *   take?: ?int,
     *   from?: ?string,
     *   sort?: ?value-of<ResourceServerSortFieldEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->q = $values['q'] ?? null;
        $this->parser = $values['parser'] ?? null;
        $this->fields = $values['fields'] ?? null;
        $this->includeFields = $values['includeFields'] ?? null;
        $this->take = $values['take'] ?? null;
        $this->from = $values['from'] ?? null;
        $this->sort = $values['sort'] ?? null;
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
     * @return ?value-of<SearchParserEnum>
     */
    public function getParser(): ?string
    {
        return $this->parser;
    }

    /**
     * @param ?value-of<SearchParserEnum> $value
     */
    public function setParser(?string $value = null): self
    {
        $this->parser = $value;
        $this->_setField('parser');
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
     * @return ?int
     */
    public function getTake(): ?int
    {
        return $this->take;
    }

    /**
     * @param ?int $value
     */
    public function setTake(?int $value = null): self
    {
        $this->take = $value;
        $this->_setField('take');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param ?string $value
     */
    public function setFrom(?string $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return ?value-of<ResourceServerSortFieldEnum>
     */
    public function getSort(): ?string
    {
        return $this->sort;
    }

    /**
     * @param ?value-of<ResourceServerSortFieldEnum> $value
     */
    public function setSort(?string $value = null): self
    {
        $this->sort = $value;
        $this->_setField('sort');
        return $this;
    }
}
