<?php

namespace Auth0\SDK\API\Management\CustomDomains\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListCustomDomainsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $q Query in <a href ="https://lucene.apache.org/core/2_9_4/queryparsersyntax.html">Lucene query string syntax</a>.
     */
    private ?string $q;

    /**
     * @var ?string $fields Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
     */
    private ?string $fields;

    /**
     * @var ?bool $includeFields Whether specified fields are to be included (true) or excluded (false).
     */
    private ?bool $includeFields;

    /**
     * @var ?string $sort Field to sort by. Only <code>domain:1</code> (ascending order by domain) is supported at this time.
     */
    private ?string $sort;

    /**
     * @param array{
     *   q?: ?string,
     *   fields?: ?string,
     *   includeFields?: ?bool,
     *   sort?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->q = $values['q'] ?? null;
        $this->fields = $values['fields'] ?? null;
        $this->includeFields = $values['includeFields'] ?? null;
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
}
