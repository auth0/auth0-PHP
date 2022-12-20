<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Request;

/**
 * Class PaginatedRequest.
 */
final class PaginatedRequest
{
    /**
     * Number of results per page for checkpoint pagination.
     */
    private ?int $take = null;

    /**
     * PaginatedRequest constructor.
     *
     * @param  int|null  $page  Page index of the results to return. First page is 0.
     * @param  int|null  $perPage  Number of results per page. Paging is disabled if parameter not set.
     * @param  bool|null  $includeTotals  return results inside an object that contains the total result count (true) or as a direct array of results (false, default)
     */
    public function __construct(
        private ?int $page = null,
        private ?int $perPage = null,
        private ?bool $includeTotals = null,
        private ?string $from = null,
    ) {
    }

    /**
     * Set the `page` for the paginated request.
     *
     * @param  int  $page  value of `page` parameter for the paginated request
     */
    public function setPage(
        int $page,
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
     * @param  int  $perPage  value of `per_page` parameter for the paginated request
     */
    public function setPerPage(
        int $perPage,
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
     * @param  string  $from  value of `from` parameter for the checkpoint-paginated request
     */
    public function setFrom(
        string $from,
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
     * @param  int  $take  value of `take` parameter for the checkpoint-paginated request
     */
    public function setTake(
        int $take,
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
     * @param  ?bool  $includeTotals  value of `include_totals` parameter for the paginated request
     */
    public function setIncludeTotals(
        ?bool $includeTotals,
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

        $page = $this->page ?? 0;
        $take = $this->take;
        $from = $this->from;
        $perPage = $this->perPage;
        $includeTotals = $this->includeTotals;

        // Are we using checkpoint pagination's ?take param?
        if (null !== $take) {
            $response['take'] = $take;
        }

        // Are we using checkpoint pagination's ?from param?
        if (null !== $from) {
            $response['from'] = $from;

            // Treat per_page as take for checkpoint pagination when a 'take' value isn't provided.
            if (null === $take && null !== $perPage) {
                $response['take'] = $perPage;
            }
        }

        // If we aren't using checkpoint pagination, and have set per_page ...
        if (null === $take && null === $from && null !== $perPage) {
            $response['page'] = $page;
            $response['per_page'] = $perPage;

            if (null !== $includeTotals) {
                $response['include_totals'] = $includeTotals ? 'true' : 'false';
            }
        }

        return $response;
    }
}
