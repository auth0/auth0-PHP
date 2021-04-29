<?php

declare(strict_types=1);

namespace Auth0\SDK\Helpers\Requests;

/**
 * Class RequestOptions.
 *
 * @package Auth0\SDK\Helpers\Requests
 */
class RequestOptions
{
    /**
     * Internal state of the field-filtered request.
     */
    protected array $state = [];

    /**
     * RequestOptions constructor
     *
     * @param array<FilteredRequest|PaginatedRequest> $options An array of FilteredRequest or PaginatedRequest objects.
     *
     * @return void
     */
    public function __construct(
        array $options = []
    ) {
        foreach ($options as $option) {
            if ($option instanceof FilteredRequest) {
                $this->state['fields'] = $option;
                continue;
            }

            if ($option instanceof PaginatedRequest) {
                $this->state['pagination'] = $option;
                continue;
            }
        }
    }

    /**
     * Assign a PaginatedRequest object, defining field filtering conditions for the API response.
     *
     * @param FilteredRequest|null $fields Request fields be included or excluded from the API response using a FilteredRequest object.
     */
    public function setFields(
        ?FilteredRequest $fields
    ): self {
        $this->state['fields'] = $fields;
        return $this;
    }

    /**
     * Retrieve a FilteredRequest object, defining field filtering conditions for the API response.
     */
    public function getFields(): ?FilteredRequest
    {
        return $this->state['fields'];
    }

    /**
     * Assign a PaginatedRequest object, defining paginated conditions for the API response.
     *
     * @param PaginatedRequest|null $pagination Request paged results using a PaginatedRequest object.
     */
    public function setPagination(
        ?PaginatedRequest $pagination
    ): self {
        $this->state['pagination'] = $pagination;
        return $this;
    }

    /**
     * Retrieve a PaginatedRequest object, defining paginated conditions for the API response.
     */
    public function getPagination(): ?PaginatedRequest
    {
        return $this->state['pagination'];
    }

    /**
     * Return an array representing the field-filtered request.
     *
     * @return array
     */
    public function build(): array
    {
        $response = [];

        if ($this->state['fields']) {
            $response += $this->state['fields']->build();
        }

        if ($this->state['pagination']) {
            $response += $this->state['pagination']->build();
        }

        return $response;
    }
}
