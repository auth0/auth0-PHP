<?php

namespace Auth0\SDK\API\Management\Actions\Versions\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListActionVersionsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?int $page Use this field to request a specific page of the list results.
     */
    private ?int $page = 0;

    /**
     * @var ?int $perPage This field specify the maximum number of results to be returned by the server. 20 by default
     */
    private ?int $perPage = 50;

    /**
     * @param array{
     *   page?: ?int,
     *   perPage?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
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
}
