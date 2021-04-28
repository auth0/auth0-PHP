<?php

declare(strict_types=1);

namespace Auth0\SDK\Helpers\Requests;

use Auth0\SDK\Helpers\FilteredRequest;
use Auth0\SDK\Helpers\PaginatedRequest;

/**
 * Class RequestOptions.
 *
 * @package Auth0\SDK\Helpers\Requests
 */
class RequestOptions
{
    /**
     * Internal state of the field-filtered request.
     *
     * @var array
     */
    protected $state = [];

    /**
     * RequestOptions constructor
     *
     * @param FilteredRequest|null  $fields     Request fields be included or excluded from the API response using a FilteredRequest object.
     * @param PaginatedRequest|null $pagination Request paged results using a PaginatedRequest object.
     *
     * @return void
     */
    public function __construct(
        ?FilteredRequest $fields = null,
        ?PaginatedRequest $pagination = null
    ) {
        $this->state['fields']     = $fields;
        $this->state['pagination'] = $pagination;
    }

    /**
     * Assign a PaginatedRequest object, defining field filtering conditions for the API response.
     *
     * @param FilteredRequest|null $fields Request fields be included or excluded from the API response using a FilteredRequest object.
     *
     * @return self
     */
    public function setFields(?FilteredRequest $fields): self
    {
        $this->state['fields'] = $fields;
        return $this;
    }

    /**
     * Retrieve a FilteredRequest object, defining field filtering conditions for the API response.
     *
     * @return FilteredRequest|null
     */
    public function getFields(): ?FilteredRequest
    {
        return $this->state['fields'];
    }

    /**
     * Assign a PaginatedRequest object, defining paginated conditions for the API response.
     *
     * @param PaginatedRequest|null $pagination Request paged results using a PaginatedRequest object.
     *
     * @return self
     */
    public function setPagination(?PaginatedRequest $pagination): self
    {
        $this->state['pagination'] = $pagination;
        return $this;
    }

    /**
     * Retrieve a PaginatedRequest object, defining paginated conditions for the API response.
     *
     * @return PaginatedRequest|null
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
            $response = $response + $this->state['fields']->build();
        }

        if ($this->state['pagination']) {
            $response = $response + $this->state['pagination']->build();
        }

        return $response;
    }
}
