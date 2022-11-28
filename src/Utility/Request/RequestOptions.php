<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility\Request;

/**
 * Class RequestOptions.
 */
final class RequestOptions
{
    /**
     * RequestOptions constructor
     *
     * @param FilteredRequest|null  $fields     An instance of FilteredRequest, for managing field-filtered requests.
     * @param PaginatedRequest|null $pagination An instance of PaginatedRequest, for managing paginated requests.
     */
    public function __construct(
        private ?FilteredRequest $fields = null,
        private ?PaginatedRequest $pagination = null
    ) {
    }

    /**
     * Assign a PaginatedRequest object, defining field filtering conditions for the API response.
     *
     * @param FilteredRequest|null $fields Request fields be included or excluded from the API response using a FilteredRequest object.
     */
    public function setFields(
        ?FilteredRequest $fields
    ): self {
        $this->fields = $fields;
        return $this;
    }

    /**
     * Retrieve a FilteredRequest object, defining field filtering conditions for the API response.
     */
    public function getFields(): ?FilteredRequest
    {
        return $this->fields;
    }

    /**
     * Assign a PaginatedRequest object, defining paginated conditions for the API response.
     *
     * @param PaginatedRequest|null $pagination Request paged results using a PaginatedRequest object.
     */
    public function setPagination(
        ?PaginatedRequest $pagination
    ): self {
        $this->pagination = $pagination;
        return $this;
    }

    /**
     * Retrieve a PaginatedRequest object, defining paginated conditions for the API response.
     */
    public function getPagination(): ?PaginatedRequest
    {
        return $this->pagination;
    }

    /**
     * Return an array representing the field-filtered request.
     *
     * @return array<int|string>
     */
    public function build(): array
    {
        $response = [];

        if ($this->fields !== null) {
            $response += $this->fields->build();
        }

        if ($this->pagination !== null) {
            $response += $this->pagination->build();
        }

        return $response;
    }
}
