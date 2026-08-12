<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetActionModulesResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<ActionModuleListItem> $modules A list of ActionsModule objects.
     */
    #[JsonProperty('modules'), ArrayType([ActionModuleListItem::class])]
    private ?array $modules;

    /**
     * @var ?int $total The total number of modules in the tenant.
     */
    #[JsonProperty('total')]
    private ?int $total;

    /**
     * @var ?int $page The page index of the returned results.
     */
    #[JsonProperty('page')]
    private ?int $page;

    /**
     * @var ?int $perPage The number of results requested per page.
     */
    #[JsonProperty('per_page')]
    private ?int $perPage;

    /**
     * @param array{
     *   modules?: ?array<ActionModuleListItem>,
     *   total?: ?int,
     *   page?: ?int,
     *   perPage?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->modules = $values['modules'] ?? null;
        $this->total = $values['total'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
    }

    /**
     * @return ?array<ActionModuleListItem>
     */
    public function getModules(): ?array
    {
        return $this->modules;
    }

    /**
     * @param ?array<ActionModuleListItem> $value
     */
    public function setModules(?array $value = null): self
    {
        $this->modules = $value;
        $this->_setField('modules');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * @param ?int $value
     */
    public function setTotal(?int $value = null): self
    {
        $this->total = $value;
        $this->_setField('total');
        return $this;
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
