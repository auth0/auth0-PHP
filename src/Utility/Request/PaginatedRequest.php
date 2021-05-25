<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Request;

/**
 * Class PaginatedRequest.
 */
class PaginatedRequest
{
    /**
     * Page index of the results to return. First page is 0.
     */
    protected ?int $page = null;

    /**
     * Number of results per page. Paging is disabled if parameter not set.
     */
    protected ?int $perPage = null;


    /**
     * Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    protected ?bool $includeTotals = null;

    /**
     * PaginatedRequest constructor.
     *
     * @param int|null  $page          Page index of the results to return. First page is 0.
     * @param int|null  $perPage       Number of results per page. Paging is disabled if parameter not set.
     * @param bool|null $includeTotals Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    public function __construct(
        ?int $page = null,
        ?int $perPage = null,
        ?bool $includeTotals = null
    ) {
        $this->page = $page;
        $this->perPage = $perPage;
        $this->includeTotals = $includeTotals;
    }

    /**
     * Set the `page` for the paginated request.
     *
     * @param int $page Value of `page` parameter for the paginated request.
     */
    public function setPage(
        int $page
    ): self {
        $this->page = $page;

        return $this;
    }

    /**
     * Retrieve the `page` for the paginated request.
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * Set the `per_page` for the paginated request.
     *
     * @param int $perPage Value of `per_page` parameter for the paginated request.
     */
    public function setPerPage(
        int $perPage
    ): self {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * Retrieve the `per_page` for the paginated request.
     */
    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    /**
     * Set the `include_totals` for the paginated request.
     *
     * @param ?bool $includeTotals Value of `include_totals` parameter for the paginated request.
     */
    public function setIncludeTotals(
        ?bool $includeTotals
    ): self {
        $this->includeTotals = $includeTotals;

        return $this;
    }

    /**
     * Retrieve the `include_totals` for the paginated request.
     */
    public function getIncludeTotals(): ?bool
    {
        return $this->includeTotals;
    }

    /**
     * Return an array representing the paginated request.
     *
     * @return array
     */
    public function build(): array
    {
        $response = [];

        if ($this->perPage !== null) {
            $response['page'] = $this->page ?? 0;
            $response['per_page'] = $this->perPage;

            if ($this->includeTotals !== null) {
                $response['include_totals'] = $this->includeTotals === true ? 'true' : 'false';
            }
        }

        return $response;
    }
}
