<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListActionBindingsPaginatedResponseContent extends JsonSerializableType
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
     * @var ?array<ActionBinding> $bindings The list of actions that are bound to this trigger in the order in which they will be executed.
     */
    #[JsonProperty('bindings'), ArrayType([ActionBinding::class])]
    private ?array $bindings;

    /**
     * @param array{
     *   total?: ?float,
     *   page?: ?float,
     *   perPage?: ?float,
     *   bindings?: ?array<ActionBinding>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->total = $values['total'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
        $this->bindings = $values['bindings'] ?? null;
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
     * @return ?array<ActionBinding>
     */
    public function getBindings(): ?array
    {
        return $this->bindings;
    }

    /**
     * @param ?array<ActionBinding> $value
     */
    public function setBindings(?array $value = null): self
    {
        $this->bindings = $value;
        $this->_setField('bindings');
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
