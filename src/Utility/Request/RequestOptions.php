<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Request;

final class RequestOptions
{
    /**
     * RequestOptions constructor.
     *
     * @param null|FilteredRequest  $fields     an instance of FilteredRequest, for managing field-filtered requests
     * @param null|PaginatedRequest $pagination an instance of PaginatedRequest, for managing paginated requests
     */
    public function __construct(
        private ?FilteredRequest $fields = null,
        private ?PaginatedRequest $pagination = null,
    ) {
    }

    /**
     * Return an array representing the field-filtered request.
     *
     * @return array<int|string>
     */
    public function build(): array
    {
        $response = [];

        if ($this->fields instanceof FilteredRequest) {
            $response += $this->fields->build();
        }

        if ($this->pagination instanceof PaginatedRequest) {
            $response += $this->pagination->build();
        }

        return $response;
    }

    /**
     * Retrieve a FilteredRequest object, defining field filtering conditions for the API response.
     */
    public function getFields(): ?FilteredRequest
    {
        return $this->fields;
    }

    /**
     * Retrieve a PaginatedRequest object, defining paginated conditions for the API response.
     */
    public function getPagination(): ?PaginatedRequest
    {
        return $this->pagination;
    }

    /**
     * Assign a PaginatedRequest object, defining field filtering conditions for the API response.
     *
     * @param null|FilteredRequest $fields request fields be included or excluded from the API response using a FilteredRequest object
     */
    public function setFields(
        ?FilteredRequest $fields,
    ): self {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Assign a PaginatedRequest object, defining paginated conditions for the API response.
     *
     * @param null|PaginatedRequest $pagination request paged results using a PaginatedRequest object
     */
    public function setPagination(
        ?PaginatedRequest $pagination,
    ): self {
        $this->pagination = $pagination;

        return $this;
    }
}
