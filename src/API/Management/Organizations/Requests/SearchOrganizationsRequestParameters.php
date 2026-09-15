<?php

namespace Auth0\SDK\API\Management\Organizations\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\SearchParserEnum;
use Auth0\SDK\API\Management\Types\OrganizationSortFieldEnum;

class SearchOrganizationsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $q Filter expression in SCIM or Lucene syntax (depending on parser parameter, default: Lucene). Lucene examples: `name:acme*`, `display_name:*auth*`. SCIM examples: `name eq "Auth0"`, `display_name sw "auth" and created_at gt "2024-01-01"`. SCIM operators: eq, ne, sw, ew, co, pr, gt, ge, lt, le, and, or. <br /><br /><b>Supported Fields</b>:<ul><li><i>id</i> - Organization ID (case-sensitive, exact match)</li><li><i>name</i> - Organization name (supports contains, starts-with, ends-with operators; sortable)</li><li><i>display_name</i> - Organization display name (supports contains, starts-with, ends-with operators; sortable)</li><li><i>created_at</i> - Creation timestamp (supports date range operators; sortable)</li><li><i>metadata.{key}</i> - Filter by organization metadata key-value pairs</li></ul>Maximum 5 filter operations per query. Results are eventually consistent and may not reflect recent updates.
     */
    private ?string $q;

    /**
     * @var ?value-of<SearchParserEnum> $parser Query parser to use for the filter expression. Use "scim" for SCIM filter syntax or "lucene" for Lucene query syntax (default).
     */
    private ?string $parser;

    /**
     * @var ?int $take Maximum number of results to return per page (1-100). Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @var ?string $from Cursor for the next page of results. Use the value from the next field in the previous response.
     */
    private ?string $from;

    /**
     * @var ?value-of<OrganizationSortFieldEnum> $sort Field name to sort results by in ascending order only. Defaults to insertion order (oldest first) if not provided.
     */
    private ?string $sort;

    /**
     * @param array{
     *   q?: ?string,
     *   parser?: ?value-of<SearchParserEnum>,
     *   take?: ?int,
     *   from?: ?string,
     *   sort?: ?value-of<OrganizationSortFieldEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->q = $values['q'] ?? null;
        $this->parser = $values['parser'] ?? null;
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
     * @return ?value-of<OrganizationSortFieldEnum>
     */
    public function getSort(): ?string
    {
        return $this->sort;
    }

    /**
     * @param ?value-of<OrganizationSortFieldEnum> $value
     */
    public function setSort(?string $value = null): self
    {
        $this->sort = $value;
        $this->_setField('sort');
        return $this;
    }
}
