<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Request;

/**
 * Class PaginatedRequest.
 */
final class PaginatedRequest
{
    /**
     * Page index of the results to return. First page is 0.
     */
    private ?int $page = null;

    /**
     * Number of results per page. Paging is disabled if parameter not set.
     */
    private ?int $perPage = null;

    /**
     * Optional ID from which to start selection. If not specified, checkpoint pagination is disabled.
     */
    private ?string $from = null;

    /**
     * Number of results per page for checkpoint pagination.
     */
    private ?int $take = null;

    /**
     * Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    private ?bool $includeTotals = null;

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
        ?bool $includeTotals = null,
        ?string $from = null
    ) {
        $this->page = $page;
        $this->perPage = $perPage;
        $this->includeTotals = $includeTotals;
        $this->from = $from;
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
     * Set the `from` for the checkpoint-paginated request.
     *
     * @param string $from Value of `from` parameter for the checkpoint-paginated request.
     */
    public function setFrom(
        string $from
    ): self {
        $this->from = $from;

        return $this;
    }

    /**
     * Retrieve the `from` for the checkpoint-paginated request.
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * Set the `take` for the paginated request.
     *
     * @param int $take Value of `take` parameter for the checkpoint-paginated request.
     */
    public function setTake(
        int $take
    ): self {
        $this->take = $take;

        return $this;
    }

    /**
     * Retrieve the `take` for the checkpoint-paginated request.
     */
    public function getTake(): ?int
    {
        return $this->take;
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
     * @return array<int|string>
     */
    public function build(): array
    {
        $response = [];

        // Are we using checkpoint pagination's ?take param?
        if ($this->take !== null) {
            $response['take'] = $this->take;
        }

        // Are we using checkpoint pagination's ?from param?
        if ($this->from !== null) {
            $response['from'] = $this->from;

            // Treat per_page as take for checkpoint pagination when a 'take' value isn't provided.
            if ($this->take === null && $this->perPage !== null) {
                $response['take'] = $this->perPage;
            }
        }

        // If we aren't using checkpoint pagination, and have set per_page ...
        if ($this->take === null && $this->from === null && $this->perPage !== null) {
            $response['page'] = $this->page ?? 0;
            $response['per_page'] = $this->perPage;

            if ($this->includeTotals !== null) {
                $response['include_totals'] = $this->includeTotals === true ? 'true' : 'false';
            }
        }

        return $response;
    }
}
