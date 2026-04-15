<?php

namespace Auth0\SDK\API\Management\Users\Logs\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListUserLogsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?int $page Page index of the results to return. First page is 0.
     */
    private ?int $page = 0;

    /**
     * @var ?int $perPage Number of results per page. Paging is disabled if parameter not sent.
     */
    private ?int $perPage = 50;

    /**
     * @var ?string $sort Field to sort by. Use `fieldname:1` for ascending order and `fieldname:-1` for descending.
     */
    private ?string $sort;

    /**
     * @var ?bool $includeTotals Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    private ?bool $includeTotals = true;

    /**
     * @param array{
     *   page?: ?int,
     *   perPage?: ?int,
     *   sort?: ?string,
     *   includeTotals?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
        $this->sort = $values['sort'] ?? null;
        $this->includeTotals = $values['includeTotals'] ?? null;
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
}
