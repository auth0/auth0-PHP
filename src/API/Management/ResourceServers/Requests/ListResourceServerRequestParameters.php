<?php

namespace Auth0\SDK\API\Management\ResourceServers\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListResourceServerRequestParameters extends JsonSerializableType
{
    /**
     * @var ?array<?string> $identifiers An optional filter on the resource server identifier. Must be URL encoded and may be specified multiple times (max 10).<br /><b>e.g.</b> <i>../resource-servers?identifiers=id1&identifiers=id2</i>
     */
    private ?array $identifiers;

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
     * @var ?bool $includeFields Whether specified fields are to be included (true) or excluded (false).
     */
    private ?bool $includeFields;

    /**
     * @param array{
     *   identifiers?: ?array<?string>,
     *   page?: ?int,
     *   perPage?: ?int,
     *   includeTotals?: ?bool,
     *   includeFields?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->identifiers = $values['identifiers'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
        $this->includeTotals = $values['includeTotals'] ?? null;
        $this->includeFields = $values['includeFields'] ?? null;
    }

    /**
     * @return ?array<?string>
     */
    public function getIdentifiers(): ?array
    {
        return $this->identifiers;
    }

    /**
     * @param ?array<?string> $value
     */
    public function setIdentifiers(?array $value = null): self
    {
        $this->identifiers = $value;
        $this->_setField('identifiers');
        return $this;
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
}
