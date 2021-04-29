<?php

declare(strict_types=1);

namespace Auth0\SDK\Helpers\Requests;

/**
 * Class PaginatedRequest.
 */
class PaginatedRequest
{
    /**
     * Internal state of the paginated request.
     */
    protected array $state = [];

    /**
     * PaginatedRequest constructor.
     *
     * @param int|null  $page          Page index of the results to return. First page is 0.
     * @param int|null  $perPage       Number of results per page. Paging is disabled if parameter not set.
     * @param bool|null $includeTotals Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     *
     * @return void
     */
    public function __construct(
        ?int $page = null,
        ?int $perPage = null,
        ?bool $includeTotals = null
    ) {
        $this->state['page'] = $page;
        $this->state['per_page'] = $perPage;
        $this->state['include_totals'] = $includeTotals;
    }

    /**
     * Set the `page` for the paginated request.
     *
     * @param int $page Value of `page` parameter for the paginated request.
     */
    public function setPage(
        int $page
    ): self {
        $this->state['page'] = $page;

        return $this;
    }

    /**
     * Retrieve the `page` for the paginated request.
     */
    public function getPage(): ?int
    {
        return $this->state['page'];
    }

    /**
     * Set the `per_page` for the paginated request.
     *
     * @param int $perPage Value of `per_page` parameter for the paginated request.
     */
    public function setPerPage(
        int $perPage
    ): self {
        $this->state['per_page'] = $perPage;

        return $this;
    }

    /**
     * Retrieve the `per_page` for the paginated request.
     */
    public function getPerPage(): ?int
    {
        return $this->state['per_page'];
    }

    /**
     * Set the `include_totals` for the paginated request.
     *
     * @param ?bool $includeTotals Value of `include_totals` parameter for the paginated request.
     */
    public function setIncludeTotals(
        ?bool $includeTotals
    ): self {
        $this->state['include_totals'] = $includeTotals;

        return $this;
    }

    /**
     * Retrieve the `include_totals` for the paginated request.
     */
    public function getIncludeTotals(): ?bool
    {
        return $this->state['include_totals'];
    }

    /**
     * Return an array representing the paginated request.
     *
     * @return array
     */
    public function build(): array
    {
        return array_filter($this->state);
    }
}
