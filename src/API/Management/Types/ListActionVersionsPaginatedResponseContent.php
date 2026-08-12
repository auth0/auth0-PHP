<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListActionVersionsPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?float $total The total result count.
     */
    #[JsonProperty('total')]
    private ?float $total;

    /**
     * @var ?float $page Page index of the results being returned. First page is 0.
     */
    #[JsonProperty('page')]
    private ?float $page;

    /**
     * @var ?float $perPage Number of results per page.
     */
    #[JsonProperty('per_page')]
    private ?float $perPage;

    /**
     * @var ?array<ActionVersion> $versions
     */
    #[JsonProperty('versions'), ArrayType([ActionVersion::class])]
    private ?array $versions;

    /**
     * @param array{
     *   total?: ?float,
     *   page?: ?float,
     *   perPage?: ?float,
     *   versions?: ?array<ActionVersion>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->total = $values['total'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
        $this->versions = $values['versions'] ?? null;
    }

    /**
     * @return ?float
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }

    /**
     * @param ?float $value
     */
    public function setTotal(?float $value = null): self
    {
        $this->total = $value;
        $this->_setField('total');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getPage(): ?float
    {
        return $this->page;
    }

    /**
     * @param ?float $value
     */
    public function setPage(?float $value = null): self
    {
        $this->page = $value;
        $this->_setField('page');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getPerPage(): ?float
    {
        return $this->perPage;
    }

    /**
     * @param ?float $value
     */
    public function setPerPage(?float $value = null): self
    {
        $this->perPage = $value;
        $this->_setField('perPage');
        return $this;
    }

    /**
     * @return ?array<ActionVersion>
     */
    public function getVersions(): ?array
    {
        return $this->versions;
    }

    /**
     * @param ?array<ActionVersion> $value
     */
    public function setVersions(?array $value = null): self
    {
        $this->versions = $value;
        $this->_setField('versions');
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
