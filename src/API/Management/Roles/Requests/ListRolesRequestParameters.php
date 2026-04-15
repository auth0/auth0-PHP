<?php

namespace Auth0\SDK\API\Management\Roles\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListRolesRequestParameters extends JsonSerializableType
{
    /**
     * @var ?int $perPage Number of results per page. Defaults to 50.
     */
    private ?int $perPage = 50;

    /**
     * @var ?int $page Page index of the results to return. First page is 0.
     */
    private ?int $page = 0;

    /**
     * @var ?bool $includeTotals Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    private ?bool $includeTotals = true;

    /**
     * @var ?string $nameFilter Optional filter on name (case-insensitive).
     */
    private ?string $nameFilter;

    /**
     * @param array{
     *   perPage?: ?int,
     *   page?: ?int,
     *   includeTotals?: ?bool,
     *   nameFilter?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->perPage = $values['perPage'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->includeTotals = $values['includeTotals'] ?? null;
        $this->nameFilter = $values['nameFilter'] ?? null;
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
    public function getNameFilter(): ?string
    {
        return $this->nameFilter;
    }

    /**
     * @param ?string $value
     */
    public function setNameFilter(?string $value = null): self
    {
        $this->nameFilter = $value;
        $this->_setField('nameFilter');
        return $this;
    }
}
